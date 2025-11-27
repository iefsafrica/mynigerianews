<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;
use App\Models\Language;
use App\Models\User;
use App\Repositories\LanguageRepository;
use File;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Laracasts\Flash\Flash;

class LanguageController extends AppBaseController
{
    /** @var LanguageRepository */
    private $languageRepository;

    public function __construct(LanguageRepository $languageRepo)
    {
        //        chmod(public_path('messages.js'),0777);
        //        chmod(lang_path(),0777);
        $this->languageRepository = $languageRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     *
     * @throws \Exception
     */
    public function index(Request $request): View
    {
        return view('languages.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateLanguageRequest $request): JsonResponse
    {
        $input = $request->all();
        $language = $this->languageRepository->create($input);
        $this->languageRepository->translationFileCreate($language);

        Artisan::call('lang:js');

        return $this->sendResponse($language, __('messages.placeholder.language_saved_successfully'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Language $language): JsonResponse
    {
        return $this->sendResponse($language, __('messages.placeholder.language_retrieved_successfully'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function show(Language $language): JsonResponse
    {
        return $this->sendResponse($language, __('messages.placeholder.language_retrieved_successfully'));
    }

    public function update(UpdateLanguageRequest $request, Language $language): JsonResponse
    {
        $input = $request->all();
        $path = App::langPath();
        rename($path.'/'.$language->iso_code, $path.'/'.$input['iso_code']);
        $this->languageRepository->update($input, $language->id);
        //        chmod(public_path('messages.js'),0777);
        Artisan::call('lang:js');

        return $this->sendSuccess(__('messages.placeholder.language_updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     *
     * @throws \Exception
     */
    public function destroy(Language $language): JsonResponse
    {
        $userLanguages = User::where('status', 1)->pluck('language')->toArray();

        if ($language->is_default == true) {
            return $this->sendError(__('messages.placeholder.default_language_deleted'));
        }

        if (in_array($language->iso_code, $userLanguages)) {
            return $this->sendError(__('messages.placeholder.language_be_deleted'));
        }

        $path = App::langPath().'/'.$language->iso_code;

        if (\File::exists($path)) {
            \File::deleteDirectory($path);
        }
        $language->delete();
        Artisan::call('lang:js');

        return $this->sendSuccess(__('messages.placeholder.language_deleted_successfully'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showTranslation(Language $language, Request $request)
    {
        $selectedLang = $request->get('name', $language->iso_code);
        $selectedFile = $request->get('file', 'messages.php');
        $langExists = $this->languageRepository->checkLanguageExistOrNot($selectedLang);
        if (! $langExists) {
            return redirect()->back()->withErrors($selectedLang.__('messages.placeholder.language_not_found'));
        }

        $fileExists = $this->languageRepository->checkFileExistOrNot($selectedLang, $selectedFile);
        if (! $fileExists) {
            return redirect()->back()->withErrors($selectedFile.__('messages.placeholder.file_not_found'));
        }

        $oldLang = app()->getLocale();
        $data = $this->languageRepository->getSubDirectoryFiles($selectedLang, $selectedFile);
        $data['id'] = $language->id;
        app()->setLocale($oldLang);
        Artisan::call('lang:js');

        return view('languages.translation-manager.index', compact('selectedLang', 'selectedFile'))->with($data);
    }

    public function updateTranslation(Language $language, Request $request): \Illuminate\Http\RedirectResponse
    {
        $lName = $language->iso_code;
        $fileName = $request->get('file_name');
        $fileExists = $this->languageRepository->checkFileExistOrNot($lName, $fileName);

        if (! $fileExists) {
            return redirect()->back()->withErrors(__('messages.placeholder.file_not_found'));
        }

        if (! empty($fileName)) {
            $result = $request->except(['_token', 'translate_language', 'file_name']);

            File::put(lang_path($lName.'/'.$fileName), '<?php return '.var_export($result, true).'?>');
        }

        Flash::success(__('messages.placeholder.language_updated_successfully'));

        return redirect()->route('languages.translation', $language->id);
    }
}
