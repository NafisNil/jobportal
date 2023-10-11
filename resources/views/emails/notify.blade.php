<x-mail::message>
# Introduction

<b>Congratulations! You are a premium user now!</b>
<p>Purchase Details: </p> <br>
<span>Plan : {{$plan}}</span> <br>
<span>Your plan ends : {{$billingEnds}}</span> 
<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
