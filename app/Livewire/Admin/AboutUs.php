<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class AboutUs extends Component
{
    use WithFileUploads;

    public $img;
    public $our_story, $our_mission, $our_vision, $the_company;

    protected $rules = [
        'our_story' => 'required|string',
        'our_mission' => 'required|string',
        'our_vision' => 'required|string',
        'the_company' => 'required|string',
        'img' => 'nullable|image|max:1024',
    ];

    public function validationAttributes()
    {
        return [
            'our_story' => __('admin.Our Story'),
            'our_mission' => __('admin.Our Mission'),
            'our_vision' => __('admin.Our Vision'),
            'the_company' => __('admin.The Company'),
            'img' => __('admin.Image'),
        ];
    }

    // معالجة التحديثات
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'our_story' => 'required|string',
            'our_mission' => 'required|string',
            'our_vision' => 'required|string',
            'the_company' => 'required|string',
        ]);
    }

    // تحديث البيانات
    public function update()
    {
        $data = $this->validate();

        // التعامل مع صورة جديدة إذا تم رفعها
        if ($this->img) {
            delete_file(setting('about_us_img'));
            $data['img'] = store_file($this->img, 'about_us');
        } else {
            $data['img'] = setting('about_us_img');
        }

        setting($data)->save();

        // عرض رسالة عند نجاح التحديث
        LivewireAlert::title('Changes saved!')->success()->show();
    }

    // تحميل البيانات عند أول استخدام
    public function mount()
    {
        $this->our_story = setting('our_story');
        $this->our_mission = setting('our_mission');
        $this->our_vision = setting('our_vision');
        $this->the_company = setting('the_company');
        $this->img = setting('about_us_img');
    }

    // عرض واجهة المستخدم
    public function render()
    {
        return view('livewire.admin.about-us');
    }
}
