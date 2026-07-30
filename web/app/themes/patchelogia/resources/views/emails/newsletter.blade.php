@extends('layouts.email')

@section('content')
    <p style="margin: 0 0 16px;">Здравствуйте!</p>

    <p style="margin: 0 0 16px;">Спасибо за подписку на рассылку {{ $siteName }}.</p>

    <p style="margin: 0 0 16px;">
        Ваш промокод:
        <strong style="font-size: 18px; letter-spacing: 1px;">{{ $promoCode }}</strong>
    </p>

    <p style="margin: 0;">Используйте его при следующей покупке.</p>
@endsection
