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
        'img' => 'nullable|image|max:1024', // Image validation rule
    ];

    // Custom validation attributes for better naming in error messages
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

    // Method for validating updates to individual fields
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'our_story' => 'required|string',
            'our_mission' => 'required|string',
            'our_vision' => 'required|string',
            'the_company' => 'required|string',
        ]);
    }

    // Method to update the data
    public function update()
    {
        $data = $this->validate();

        // Handle new image if uploaded
        if ($this->img) {
            delete_file(setting('about_us_img')); // Delete the old image if exists
            $data['img'] = store_file($this->img, 'about_us'); // Store the new image
        } else {
            $data['img'] = setting('about_us_img'); // Use the old image if no new one is uploaded
        }

        setting($data)->save(); // Save settings to the database

        // Show success message after saving the data
        LivewireAlert::title('Changes saved!')->success()->show();
    }

    // Method to load data when the component is first used
    public function mount()
    {
        $this->our_story = setting('our_story');
        $this->our_mission = setting('our_mission');
        $this->our_vision = setting('our_vision');
        $this->the_company = setting('the_company');
        $this->img = setting('about_us_img');
    }

    // Render the component view
    public function render()
    {
        return view('livewire.admin.about-us');
    }
}
