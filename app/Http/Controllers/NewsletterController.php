<?php

namespace App\Http\Controllers;
use App\Http\Requests\NewsletterRequests\NewsletterRequest;
use Illuminate\Http\Request;
use App\Models\Newsletter;
class NewsletterController extends Controller
{
    public function store(NewsletterRequest $request)
    {
       return Newsletter::store($request);
    }
}
