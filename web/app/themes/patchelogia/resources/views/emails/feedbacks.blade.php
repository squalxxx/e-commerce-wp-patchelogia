@extends('layouts.email')

@section('content')
    <p style="margin: 0 0 16px;">Здравствуйте, {{ $name }}!</p>

    <p style="margin: 0 0 16px;">Спасибо за Ваше обращение в "Отдел заботы" — {{ $siteName }}.</p>

    <p style="margin: 0 0 16px;">
        <strong>
            Мы уже стараемся обработать Вашу заявку как можно быстрее и дать Вам обратную связь! Подождите чуть-чуть...
        </strong>
    </p>
@endsection
