<?php
$notifications = App\Models\Notification::query()->where('user_id', Illuminate\Support\Facades\Auth::user()->id)->get();
?>

<div class="notifications">
@foreach($notifications as $notification)
    @if($notification->type == 'bool')
        <div id="notification_{{ $notification->code }}" class="notification">
            <div class="notification_top">
                <div class="notification_icon_wrapper">
                    <div class="notification_icon_circle">
                        <div class="notification_icon_inner">i</div>
                    </div>
                </div>

                <div class="notification_content">
                    <p class="notification_title">Приглашение</p>
                    <p class="notification_text">{!! $notification->text !!}</p>
                </div>
            </div>

            <div class="notification_bottom">
                <button onclick="companyInvitationSuccess(this)" data-code="{{ $notification->code }}" type="button" class="btn btn-alt-success notification_success">Принять</button>
                <button onclick="companyInvitationCancel(this)" data-code="{{ $notification->code }}" type="button" class="btn btn-alt-danger">Отменить</button>
            </div>
        </div>
    @endif

    @if($notification->type == 'confirm')
        <div id="notification_{{ $notification->code }}" class="notification">
            <div class="notification_top">
                <div class="notification_icon_wrapper">
                    <div class="notification_icon_circle">
                        <div class="notification_icon_inner">i</div>
                    </div>
                </div>

                <div class="notification_content">
                    <p class="notification_title">{{ $notification->title }}</p>
                    <p class="notification_text">{!! $notification->text !!}</p>
                </div>
            </div>

            <div class="notification_bottom">
                <button onclick="notificationDelete(this)" data-code="{{ $notification->code }}" type="button" class="btn btn-alt-primary notification_success">OK</button>
            </div>
        </div>
    @endif
@endforeach
</div>
