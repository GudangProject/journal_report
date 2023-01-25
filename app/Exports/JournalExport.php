<?php

namespace App\Exports;

use App\Models\Journals\Journal as JournalsJournal;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class JournalExport implements FromView
{
    public function __construct($id)
    {
        $this->selectedKeys = $id;
    }

    public function view(): View
    {
        $data = JournalsJournal::whereIn('id', $this->selectedKeys)->orderByDesc('created_at')->get();
        return view('admin.journals.reports.exports.journal', [
            'data' => $data
        ]);
    }
}
