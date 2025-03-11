<div>
    <!-- Form for updating About Us data -->
    <form wire:submit.prevent="update">
        <!-- Our Story Textarea -->
        <div class="mb-4">
            <label for="our_story" class="block font-medium">{{ __('admin.Our Story') }}</label>
            <textarea id="our_story" wire:model="our_story" class="w-full p-2 border" required>{{ old('our_story', $our_story) }}</textarea>
            @error('our_story') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <!-- Our Mission Textarea -->
        <div class="mb-4">
            <label for="our_mission" class="block font-medium">{{ __('admin.Our Mission') }}</label>
            <textarea id="our_mission" wire:model="our_mission" class="w-full p-2 border" required>{{ old('our_mission', $our_mission) }}</textarea>
            @error('our_mission') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <!-- Our Vision Textarea -->
        <div class="mb-4">
            <label for="our_vision" class="block font-medium">{{ __('admin.Our Vision') }}</label>
            <textarea id="our_vision" wire:model="our_vision" class="w-full p-2 border" required>{{ old('our_vision', $our_vision) }}</textarea>
            @error('our_vision') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <!-- The Company Textarea -->
        <div class="mb-4">
            <label for="the_company" class="block font-medium">{{ __('admin.The Company') }}</label>
            <textarea id="the_company" wire:model="the_company" class="w-full p-2 border" required>{{ old('the_company', $the_company) }}</textarea>
            @error('the_company') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <!-- Image Upload -->
        <div class="mb-4">
            <label for="img" class="block font-medium">{{ __('admin.Image') }}</label>
            <input id="img" type="file" wire:model="img" class="w-full p-2 border" accept="image/*">
            @error('img') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <!-- Submit Button -->
        <div class="mb-4">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">{{ __('admin.Save Changes') }}</button>
        </div>
    </form>
</div>
