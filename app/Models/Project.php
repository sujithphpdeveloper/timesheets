<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'status'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function timesheets(): HasMany
    {
        return $this->hasMany(Timesheet::class);
    }

    public function attributeValues(): HasMany
    {
        return $this->hasMany(AttributeValue::class, 'entity_id');
    }
}
