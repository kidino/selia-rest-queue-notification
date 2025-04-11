@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
@else
<img src="https://aplikasi.test/kp-logo-favicon.png" 
width="50" height="50" /><br>
{{ $slot }}
@endif
</a>
</td>
</tr>
