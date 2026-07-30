<div class="wrap">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1 class="wp-heading-inline">Заявки на амбассадорство</h1>

        <span style="margin-left:12px;color:#666">
            Всего заявок: {{ count($ambassadors) }}
        </span>
    </div>

    <hr class="wp-header-end">

    @if (empty($ambassadors))
        <p>Заявок пока нет.</p>
    @else
        <table class="widefat striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Профиль</th>
                    <th>Почта / Телефон</th>
                    <th>Комментарий</th>
                    <th>Дата подачи</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($ambassadors as $ambassador)
                    <tr>
                        <td><strong>{{ $ambassador->id }}</strong></td>

                        <td><strong>{{ $ambassador->name }}</strong></td>

                        <td>
                            {{ $ambassador->link }}
                        </td>

                        <td>
                            <code>
                                @if (!empty($ambassador->email))
                                    {{ $ambassador->email }}
                                @endif

                                @if (!empty($ambassador->email) && !empty($ambassador->phone))
                                    /
                                @endif

                                @if (!empty($ambassador->phone))
                                    {{ $ambassador->phone }}
                                @endif
                            </code>
                        </td>

                        <td style="max-width: 240px;">
                            {{ $ambassador->comment }}
                        </td>

                        <td>
                            {{ wp_date('d.m.Y H:i', strtotime($ambassador->created_at)) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
