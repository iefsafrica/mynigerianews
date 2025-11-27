<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSeoToolRequest;
use App\Models\SeoTool;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Arr;
use Laracasts\Flash\Flash;

class seoToolsController extends AppBaseController
{
    /**
     * @return Application|Factory|View
     */
    public function index(): \Illuminate\View\View
    {
        $seoTool = SeoTool::with('language')->first();

        return view('seo_Tools.index', compact('seoTool'));
    }

    /**
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateSeoToolRequest $request): RedirectResponse
    {
        if (count(explode(' ', $request->keyword)) > 10) {
            return redirect()->back()->withErrors([__('messages.placeholder.keyword_should_be_of_maximum_10_words_only')]);
        }
        $input = Arr::except($request->all(), '_token');
        $input['google_analytics'] = ($request->google_analytics) ? $request->google_analytics : '';
        $seoTool = SeoTool::first();
        $seoTool->update($input);
        Flash::success(__('messages.placeholder.seo_tools_updated_successfully'));

        return redirect(route('seo-tools.index'));
    }
}
