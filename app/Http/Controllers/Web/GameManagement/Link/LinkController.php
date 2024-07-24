<?php

namespace App\Http\Controllers\Web\GameManagement\Link;

use App\Http\Controllers\Controller;
use App\Services\Link\LinkService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    /**
     * @param LinkService $linkService
     */
    public function __construct(
        private LinkService $linkService,
    )
    {
    }

    /**
     * @param string $hash
     * @return Application|Factory|View
     */
    public function preview(string $hash): Application|Factory|View
    {
        $link = $this->linkService->get($hash);

        return view('web.link.preview', [
            'link' => $link
        ]);
    }

    /**
     * @param string $hash
     * @return Factory|View|Application
     */
    public function show(string $hash)
    {
        $link = $this->linkService->get($hash);

        return view('web.link.show', ['link' => $link]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $currentLink = $this->linkService->get($request->get('link_hash'));

        $link = $this->linkService->getLinkInstance();
        $currentLink->user->links()->save($link);

        return redirect()->route('link.preview', ['hash' => $link->hash]);
    }

    /**
     * @param string $hash
     * @return RedirectResponse
     */
    public function delete(string $hash)
    {
        try {
            $this->linkService->delete($hash);
        } catch (\Exception) {
            return back()->with('error', 'Something went wrong.');
        }

        return redirect('/')->with('success', 'Link deleted');
    }
}
