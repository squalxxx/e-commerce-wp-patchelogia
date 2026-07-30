<div class="wrap">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1 class="wp-heading-inline">Отдел заботы (заявки обратной связи)</h1>

        <span style="margin-left:12px;color:#666">
            Всего заявок: {{ count($feedbacks) }}
        </span>
    </div>

    <hr class="wp-header-end">

    @if (empty($feedbacks))
        <p>Подписчиков пока нет.</p>
    @else
        <table class="widefat striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Почта или телефон</th>
                    <th>Комментарий</th>
                    <th>Дата подачи</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($feedbacks as $feedback)
                    <tr>
                        <td>
                            <strong>{{ $feedback->id }}</strong>
                        </td>

                        <td>
                            <strong>{{ $feedback->name }}</strong>
                        </td>

                        <td>
                            <code>{{ $feedback->email ?: $feedback->phone }}</code>
                        </td>

                        <td style="max-width: 200px;">
                            {{ $feedback->comment ?: 'Не заполнен' }}
                        </td>

                        <td>
                            {{ wp_date('d.m.Y H:i', strtotime($feedback->created_at)) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
