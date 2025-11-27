<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Models\Menu;
use App\Models\Navigation;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class MenuController extends AppBaseController
{
    public function index(Request $request): \Illuminate\View\View
    {
        return view('menu.index');
    }

    /**
     * Show the form for creating a new Staff.
     *
     * @return Application|Factory|View
     */
    public function create(): \Illuminate\View\View
    {
        $menus = Menu::where('parent_menu_id', null)->orderBy('id', 'ASC')->pluck('title', 'id');

        return view('menu.create', compact('menus'));
    }

    public function store(CreateMenuRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $input = $request->all();
            $input['show_in_menu'] = (isset($input['show_in_menu'])) ? Menu::SHOW_MENU_ACTIVE : Menu::SHOW_MENU_DEACTIVE;
            $menu = Menu::create($input);

            if (isset($menu['parent_menu_id'])) {
                $navigationOrder = Navigation::whereNavigationableType(Menu::class)
                    ->whereParentId($menu['parent_menu_id'])->count() + 1;
            } else {
                $navigationOrder = Navigation::whereNull('parent_id')->count() + 1;
            }

            Navigation::create([
                'navigationable_type' => Menu::class,
                'navigationable_id' => $menu['id'],
                'order_id' => $navigationOrder,
                'parent_id' => $menu['parent_menu_id'] ?? null,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }

        Flash::success(__('messages.placeholder.menu_created_successfully'));

        return redirect(route('menus.index'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit(Menu $menu): \Illuminate\View\View
    {
        $menu = Menu::with(['parent', 'submenu'])->findOrFail($menu['id']);
        $menus = Menu::where('id', '!=', $menu['id'])->whereNull('parent_menu_id')
            ->orderBy('id', 'ASC')->pluck('title', 'id');

        return view('menu.edit', compact('menu', 'menus'));
    }

    public function update(UpdateMenuRequest $request, Menu $menu): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $input = $request->all();
            $input['show_in_menu'] = (isset($input['show_in_menu'])) ? 1 : 0;
            $oldParentId = $menu['parent_menu_id'];
            $changeParentMenu = $input['parent_menu_id'] != $oldParentId;

            $menu->update($input);
            if ($changeParentMenu) {
                if (isset($menu['parent_menu_id'])) {
                    $navigationOrder = Navigation::whereNavigationableType(Menu::class)
                        ->whereParentId($menu['parent_menu_id'])->count() + 1;
                } else {
                    $navigationOrder = Navigation::whereNull('parent_id')->count() + 1;
                }
                $menu->navigation->update([
                    'order_id' => $navigationOrder,
                    'parent_id' => $menu['parent_menu_id'] ?? null,
                ]);
                if (isset($oldParentId)) {
                    $subsNavigation = Navigation::whereNavigationableType(Menu::class)
                        ->whereParentId($oldParentId)->orderBy('order_id')->get();
                    foreach ($subsNavigation as $key => $navigation) {
                        $navigation->update([
                            'order_id' => $key + 1,
                        ]);
                    }
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }

        Flash::success(__('messages.placeholder.menu_update_successfully'));

        return redirect(route('menus.index'));
    }

    public function destroy(Menu $menu): JsonResponse
    {
        $menuId = $menu->id;
        $parentMenuId = $menu->parent_menu_id;

        $menu->navigation()->delete();

        if (is_null($parentMenuId)) {
            Navigation::whereNavigationableType(Menu::class)->whereParentId($menuId)->delete();
        } else {
            $subsNavigation = Navigation::whereNavigationableType(Menu::class)
                ->whereParentId($parentMenuId)->orderBy('order_id')->get();
            foreach ($subsNavigation as $key => $navigation) {
                $navigation->update([
                    'order_id' => $key + 1,
                ]);
            }
        }

        $menu->delete();

        return $this->sendSuccess(__('messages.placeholder.menu_deleted_successfully'));
    }
}
