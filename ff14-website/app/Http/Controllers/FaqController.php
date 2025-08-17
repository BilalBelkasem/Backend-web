<?php

namespace App\Http\Controllers;

use App\Models\FaqCategory;
use App\Models\FaqItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FaqController extends Controller
{
    /**
     * Display FAQ page
     */
    public function index()
    {
        $categories = FaqCategory::with('faqItems')->get();
        return view('faq.index', compact('categories'));
    }

    /**
     * Show form to create FAQ category
     */
    public function createCategory()
    {
        return view('faq.create-category');
    }

    /**
     * Store FAQ category
     */
    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255'
        ]);

        FaqCategory::create($request->all());

        return redirect()->route('faq.index')->with('success', 'FAQ categorie aangemaakt!');
    }

    /**
     * Show form to create FAQ item
     */
    public function createItem()
    {
        $categories = FaqCategory::all();
        return view('faq.create-item', compact('categories'));
    }

    /**
     * Store FAQ item
     */
    public function storeItem(Request $request)
    {
        $request->validate([
            'question' => 'required|max:255',
            'answer' => 'required',
            'faq_category_id' => 'required|exists:faq_categories,id'
        ]);

        FaqItem::create($request->all());

        return redirect()->route('faq.index')->with('success', 'FAQ item toegevoegd!');
    }

    /**
     * Delete FAQ category
     */
    public function destroyCategory($id)
    {
        $category = FaqCategory::findOrFail($id);
        $category->delete();

        return redirect()->route('faq.index')->with('success', 'FAQ categorie verwijderd!');
    }

    /**
     * Delete FAQ item
     */
    public function destroyItem($id)
    {
        $item = FaqItem::findOrFail($id);
        $item->delete();

        return redirect()->route('faq.index')->with('success', 'FAQ item verwijderd!');
    }
}
