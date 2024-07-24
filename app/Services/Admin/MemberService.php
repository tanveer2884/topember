<?php

namespace App\Services\Admin;

use App\Models\Member;
use App\Traits\WithSaveImages;

class MemberService
{
    use WithSaveImages;

    private Member $member;

    /**
     * @var array<mixed>
     */
    private array $images = [];

    public function withModel(Member $member): self
    {
        $this->member = $member;

        return $this;
    }

    public function getMediaModel(): Member
    {
        return $this->member;
    }

    /**
     * @param  array<mixed>  $images
     */
    public function withImage(array $images = []): self
    {
        $this->images = $images;

        return $this;
    }

    public function save(): Member
    {
        $this->member->save();

        $this->updateImages();

        return $this->member;
    }
}
