<?php

namespace App\Models\Journals;

use App\Models\User;
use App\Models\Journals\Journal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Journals\Naskah;
use App\Models\Journals\Knowledge;
use App\Services\DateServices;
use App\Models\Journals\Mybank;
use Carbon\Carbon;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['knowledge'];

    public function createBy(){
        return $this->belongsTo(User::class, 'created_by');
    }

    public function mybank(){
        return $this->belongsTo(Mybank::class, 'mybank_id');
    }

    public function journal(){
        return $this->belongsTo(Journal::class, 'journal_id')->withTrashed();
    }

    public function getKnowledgeAttribute(){
        return Knowledge::findOrFail($this->journal->knowledge_id)->name;
    }

    public function naskah(){
        return Naskah::where('journal_id', $this->journal_id)->where('payment_id', $this->id)->get();
    }

    public function getDateAttribute()
    {
        return DateServices::dateHome($this->created_at);
    }

    public function getDateOriginalAttribute()
    {
        return Carbon::parse($this->crated_at)->format('d-m-Y h:m:s');
    }
}
