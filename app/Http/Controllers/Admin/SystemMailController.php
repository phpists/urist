<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SystemMail;
use Illuminate\Http\Request;

class SystemMailController extends Controller
{

    public function edit(SystemMail $systemMail)
    {
        if (!view()->exists("admin.system-mails.{$systemMail->name}"))
            abort(404);

        return view("admin.system-mails.{$systemMail->name}", [
            'model' => $systemMail
        ]);
    }

    public function update(Request $request, SystemMail $systemMail)
    {
        $systemMail->subject = $request->post('subject');
        $systemMail->body = $request->post('body');

        if ($systemMail->save()) {
            return to_route('admin.system-mails.edit', $systemMail)
                ->with('success', 'Зміни успішно збережено');
        }

        return back()->with('error', 'Не вдалось зберегти дані');
    }

}
