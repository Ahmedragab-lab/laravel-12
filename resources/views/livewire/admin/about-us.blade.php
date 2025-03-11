<div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile shadow">
                <div class="row">
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="img" >@lang('settings.Logo_Image')</label>
                                    <input type="file" id="img"  class="form-control" wire:model="img"  accept="image/*">
                                    @error('img')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                @if($img)
                                    <img src="{{ $img->temporaryUrl() }}" width='80' alt="">
                                @else
                                    <img src="{{ display_file(setting('img')) }}" width='80' alt="">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="img" >@lang('settings.Browser_Icon')</label>
                                    <input type="file" id="img"  class="form-control" wire:model="img"  accept="image/*">
                                    @error('img')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                @if($img)
                                    <img src="{{ $img->temporaryUrl() }}" width='70' alt="">
                                @else
                                    <img src="{{ display_file(setting('img')) }}" width='70' alt="">
                                @endif
                            </div>
                        </div>
                    </div>




                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">{{ __('admin.Site name') }}</label>
                            <input type="text" class="form-control" wire:model.live="site_name" autocomplete="off">
                            {{-- {{ var_export($site_name) }} --}}
                            @error('site_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">{{ __('admin.url') }}</label>
                            <input type="text" class="form-control" wire:model.live="url" autocomplete="off">
                            {{-- {{ var_export($url) }} --}}
                            @error('url')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">{{ __('admin.phone') }}</label>
                            <input type="text" class="form-control" wire:model.live="phone" autocomplete="off">
                            {{-- {{ var_export($phone) }} --}}
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">{{ __('admin.SMS Username') }}</label>
                            <input type="text" class="form-control" wire:model.live="sms_username"
                                autocomplete="off">
                            {{-- {{ var_export($sms_username) }} --}}
                            @error('sms_username')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">{{ __('admin.SMS Sender') }}</label>
                            <input type="text" class="form-control" wire:model.live="sms_sender" autocomplete="off">
                            {{-- {{ var_export($sms_sender) }} --}}
                            @error('sms_sender')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">{{ __('admin.SMS Password') }}</label>
                            <input type="text" class="form-control" wire:model.live="sms_password"
                                autocomplete="off">
                            {{-- {{ var_export($sms_password) }} --}}
                            @error('sms_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">{{ __('admin.email') }}</label>
                            <input type="email" class="form-control" wire:model.live="email" autocomplete="off">
                            {{-- {{ var_export($email) }} --}}
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="toggle-flip">
                            <label>
                                <span class="label-text">{{ __('admin.SMS status') }}</span>
                                <input type="checkbox" wire:model.live="sms_status">
                                <span class="flip-indecator mt-3" data-toggle-on="@lang('admin.open')"
                                    data-toggle-off="@lang('admin.close')"></span>
                            </label>
                        </div>
                        {{-- {{ var_export($sms_status) }} --}}
                    </div>
                    <div class="col-md-3">
                        <div class="toggle-flip">
                            <label>
                                <span class="label-text">{{ __('admin.Tax enabled') }}</span>
                                <input type="checkbox" wire:model.live="tax_enabled">
                                <span class="flip-indecator mt-3" data-toggle-on="@lang('admin.open')"
                                    data-toggle-off="@lang('admin.close')"></span>
                            </label>
                        </div>
                        {{-- {{ var_export($tax_enabled) }} --}}
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">{{ __('admin.Tax rate') }}</label>
                            <input type="text" class="form-control" wire:model.live="tax_rate" autocomplete="off">
                            {{-- {{ var_export($tax_rate) }} --}}
                            @error('tax_rate')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">{{ __('admin.Tax number') }}</label>
                            <input type="text" class="form-control" wire:model.live="tax_no" autocomplete="off">
                            {{-- {{ var_export($tax_no) }} --}}
                            @error('tax_no')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">{{ __('admin.address') }}</label>
                            <input type="text" class="form-control" wire:model.live="address" autocomplete="off">
                            {{-- {{ var_export($address) }} --}}
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">{{ __('admin.Build number') }}</label>
                            <input type="text" class="form-control" wire:model.live="build_num"
                                autocomplete="off">
                            {{-- {{ var_export($build_num) }} --}}
                            @error('build_num')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">{{ __('admin.Unit number') }}</label>
                            <input type="text" class="form-control" wire:model.live="unit_num"
                                autocomplete="off">
                            {{-- {{ var_export($unit_num) }} --}}
                            @error('unit_num')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">{{ __('admin.Postal code') }}</label>
                            <input type="text" class="form-control" wire:model.live="postal_code"
                                autocomplete="off">
                            {{-- {{ var_export($postal_code) }} --}}
                            @error('postal_code')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">{{ __('admin.Extra number') }}</label>
                            <input type="text" class="form-control" wire:model.live="extra_number"
                                autocomplete="off">
                            {{-- {{ var_export($extra_number) }} --}}
                            @error('extra_number')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">{{ __('capital') }}</label>
                            <input type="text" class="form-control" wire:model.live="capital" autocomplete="off">
                            {{-- {{ var_export($capital) }} --}}
                            @error('capital')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="animated-checkbox">
                            <label>
                                <input type="checkbox" wire:model.live="delete_transfer">
                                <span class="label-text">{{ __('admin.Delete transfer patients') }}</span>
                            </label>
                        </div>
                        @error('delete_transfer')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <div class="animated-checkbox">
                            <label>
                                <input type="checkbox" wire:model.live="activate_medicines">
                                <span class="label-text">تفعيل الادويه</span>
                            </label>
                        </div>
                        @error('activate_medicines')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <div class="animated-checkbox">
                            <label>
                                <input type="checkbox" wire:model.live="active_scan_and_lab">
                                <span class="label-text">تفعيل الاشعه</span>
                            </label>
                        </div>
                        @error('active_scan_and_lab')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <div class="animated-checkbox">
                            <label>
                                <input type="checkbox" wire:model.live="new_invoice_form">
                                <span class="label-text">تفعيل الطابعه الحراريه</span>
                            </label>
                        </div>
                        @error('new_invoice_form')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <div class="animated-checkbox">
                            <label>
                                <input type="checkbox" wire:model.live="complaint">
                                <span class="label-text">إظهار حقل الشكوى والكشف السريري في التشخيص</span>
                            </label>
                        </div>
                        @error('complaint')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <div class="toggle-flip">
                            <label>
                                <span class="label-text">{{ __('admin.status') }}</span>
                                <input type="checkbox" wire:model.live="status">
                                <span class="flip-indecator mt-3" data-toggle-on="@lang('admin.open')"
                                    data-toggle-off="@lang('admin.close')"></span>
                            </label>
                        </div>
                        {{-- {{ var_export($status) }} --}}
                    </div>
                    <div class="form-group col-md-12">
                        <label class="main-lable" for="">{{ __('admin.Message status') }}</label>
                        <textarea wire:model.live="message_status"  class="form-control " id="message" ></textarea>
                        @error('message_status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-12 text-center mt-3">
                        <h5 class="mx-auto w-fit line-bottom-blue mb-4">{{ __('admin.Morning and evening settings') }}</h5>
                    </div>
                    <div class="col-md-6 text-center mt-3">
                        <h6 class="text-center mb-3">{{ __('admin.Morning time') }}</h6>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">{{ __('admin.from') }}</label>
                                        <input type="time" class="form-control" wire:model.live="from_morning" autocomplete="off">
                                        {{-- {{ var_export($from_morning) }} --}}
                                        @error('from_morning')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">{{ __('admin.to') }}</label>
                                        <input type="time" class="form-control" wire:model.live="to_morning" autocomplete="off">
                                        {{-- {{ var_export($to_morning) }} --}}
                                        @error('to_morning')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 text-center mt-3">
                        <h6 class="text-center mb-3">{{ __('admin.Evening time') }}</h6>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">{{ __('admin.from') }}</label>
                                        <input type="time" class="form-control" wire:model.live="from_evening" autocomplete="off">
                                        {{-- {{ var_export($from_evening) }} --}}
                                        @error('from_evening')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">{{ __('admin.to') }}</label>
                                        <input type="time" class="form-control" wire:model.live="to_evening" autocomplete="off">
                                        {{-- {{ var_export($to_evening) }} --}}
                                        @error('to_evening')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button wire:click="update"  class="btn btn-primary"><i class="fa fa-edit"></i> @lang('site.update')</button>
                </div>
            </div><!-- end of title -->
        </div><!-- end of col -->
    </div><!-- end of row -->
</div>

