<?php

namespace App\Livewire\Admin\Cms\Members;

use App\Models\Member;
use Livewire\WithFileUploads;
use App\Livewire\Traits\Notifies;
use App\Livewire\Traits\HasImages;
use Illuminate\Contracts\View\View;
use App\Services\Admin\MemberService;
use App\Livewire\Admin\Cms\CmsAbstract;
use Illuminate\Database\Eloquent\Model;
use App\Livewire\Traits\RegistersDynamicListeners;

abstract class MemberAbstract extends CmsAbstract
{
    use Notifies;
    use WithFileUploads;
    use HasImages;
    use RegistersDynamicListeners;

    public Member $member;

    /**
     * @return array<string,string>
     */
    protected function getListeners(): array
    {
        return array_merge(
            $this->getDynamicListeners(),
            $this->getHasImagesListeners()
        );
    }

    public function getMediaModel(): Model
    {
        return $this->member;
    }

    /**
     * Define the validation rules.
     *
     * @return array<mixed>
     */
    public function rules(): array
    {
        return [
            'member.title' => 'bail|required',
            'member.slug' => 'bail|nullable|unique:members,slug,'.$this->member->id,
            'member.designation' => 'bail|required',
            'member.twitter' => 'bail|nullable|url',
            'member.linkedin' => 'bail|nullable|url',
            'member.google' => 'bail|nullable|url',
            'images' => 'required',
        ];
    }

    /**
     * Custom attribute name's mapping
     *
     * @return array<mixed>
     */
    protected function validationAttributes()
    {
        return collect($this->images)
            ->mapWithKeys(fn ($value, $key) => ["images.{$key}" => 'image'])
            ->toArray();
    }

    /**
     * Save the blog in database
     */
    public function save(MemberService $memberService): void
    {
        $this->validate();

        try {
            $memberService->withModel($this->member)
                ->withImage($this->images)
                ->save();

            $type = $this->member->wasRecentlyCreated ? 'created' : 'updated';

            $this->notify("Member {$type} successfully.", 'admin.cms.members.index');
        } catch (\Throwable $th) {
            $this->notify($th->getMessage(), level: 'error');
        }
    }

    public function render(): View
    {
        $title = $this->member->id ? 'edit' : 'create';

        return $this->view('livewire.admin.cms.members.member-form')
            ->with('memberTitle', "member.{$title}.title");
    }
}
