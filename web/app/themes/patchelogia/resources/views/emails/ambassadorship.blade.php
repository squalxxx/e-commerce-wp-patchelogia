@extends('layouts.email')

@section('content')
    <p style="margin: 0 0 16px;">Новая заявка на амбассадорство.</p>

    <table
        cellpadding="0"
        cellspacing="0"
        role="presentation"
        style="margin: 0 0 16px;"
        width="100%"
    >
        <tr>
            <td style="padding: 4px 0; color: #666;">Имя:</td>
            <td style="padding: 4px 0;"><strong>{{ $name }}</strong></td>
        </tr>

        <tr>
            <td style="padding: 4px 0; color: #666;">Профиль:</td>
            <td style="padding: 4px 0;">{{ $link }}</td>
        </tr>

        @if ($email)
            <tr>
                <td style="padding: 4px 0; color: #666;">Почта:</td>
                <td style="padding: 4px 0;">{{ $email }}</td>
            </tr>
        @endif

        @if ($phone)
            <tr>
                <td style="padding: 4px 0; color: #666;">Телефон:</td>
                <td style="padding: 4px 0;">{{ $phone }}</td>
            </tr>
        @endif
    </table>

    <p style="margin: 0 0 8px; color: #666;">Комментарий:</p>
    <p style="margin: 0; white-space: pre-line;">{{ $comment }}</p>
@endsection
