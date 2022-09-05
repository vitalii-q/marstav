<?php
$notifications = App\Models\Notification::query()->where('user_id', Illuminate\Support\Facades\Auth::user()->id)->get();
?>

<div class="notifications">
@foreach($notifications as $notification)
    @if($notification->type == 'info')
        <div id="notification_{{ $notification->code }}" class="notification">
            <div class="notification_top">
                <div class="notification_icon_wrapper">
                    <div class="notification_icon_circle">
                        <div class="notification_icon_inner">i</div>
                    </div>
                </div>

                <div class="notification_content">
                    <p class="notification_title">Приглашение</p>
                    <p class="notification_text">{{ htmlentities($notification->text, ENT_COMPAT, 'UTF-8') }}</p>
                </div>
            </div>

            <div class="notification_bottom">
                <button onclick="companyInvitationSuccess(this)" data-code="{{ $notification->code }}" type="button" class="btn btn-alt-success notification_success">Принять</button>
                <button onclick="companyInvitationCancel(this)" data-code="{{ $notification->code }}" type="button" class="btn btn-alt-danger">Отменить</button>
            </div>
        </div>
    @endif
@endforeach
</div>
