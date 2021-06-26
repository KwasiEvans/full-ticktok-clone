<div class="ellipish-close-btn">
    <a href="javascript:void(0)" onclick="cancel_ellipish()"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="17" height="17" viewBox="0 0 17 17">
<g>
</g>
  <path d="M9.207 8.5l6.646 6.646-0.707 0.707-6.646-6.646-6.646 6.646-0.707-0.707 6.646-6.646-6.647-6.646 0.707-0.707 6.647 6.646 6.646-6.646 0.707 0.707-6.646 6.646z" fill="#ED4956" />
</svg></a>
</div>
<div class="ellipish-list text-center">
	<form id="user_report_form" action="{{ route('user_report') }}" method="POST">
		@csrf
		<textarea class="embed_textarea" name="body" placeholder="Write report issue"></textarea>
		<input type="hidden" name="user_id" value="{{ $user->id }}">
		<button type="submit" class="embed_action">{{ __('Send Report') }}</button>
	</form>
</div>

<script src="{{ asset('frontend/js/report.js') }}"></script>
