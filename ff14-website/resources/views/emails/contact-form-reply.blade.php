<p>Hallo {{ $messageModel->name }},</p>

<p>We hebben je bericht ontvangen met onderwerp "{{ $messageModel->subject }}". Hieronder ons antwoord:</p>

<blockquote style="border-left:4px solid #999;padding-left:10px;color:#555;">{!! nl2br(e($messageModel->admin_reply)) !!}</blockquote>

<p>Je oorspronkelijk bericht:</p>
<blockquote style="border-left:4px solid #ddd;padding-left:10px;color:#777;">{!! nl2br(e($messageModel->message)) !!}</blockquote>

<p>Met vriendelijke groet,<br/>Het FF14 Community Team</p>


