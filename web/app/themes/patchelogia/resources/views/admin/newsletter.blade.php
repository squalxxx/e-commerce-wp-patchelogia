<div class="wrap">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1 class="wp-heading-inline">Участники рассылки</h1>

        <span style="margin-left:12px;color:#666">
            Всего подписано: {{ count($subscriptions) }}
        </span>
    </div>

    <hr class="wp-header-end">

    @if (empty($subscriptions))
        <p>Подписчиков пока нет.</p>
    @else
        <table class="widefat striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Промокод</th>
                    <th>Активирован</th>
                    <th>Дата</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($subscriptions as $subscription)
                    <tr>
                        <td>
                            <strong>{{ $subscription->id }}</strong>
                        </td>

                        <td>
                            <strong>{{ $subscription->email }}</strong>
                        </td>

                        <td>
                            <code>{{ $subscription->promo_code }}</code>
                        </td>

                        <td>

                            @if ($subscription->activated_at)
                                <span style="color:#00a32a">
                                    ● Активирован
                                    ({{ wp_date('d.m.Y H:i', strtotime($subscription->activated_at)) }})
                                </span>
                            @else
                                <span style="color:#d63638">
                                    ● Не использован
                                </span>
                            @endif
                        </td>

                        <td>
                            {{ wp_date('d.m.Y H:i', strtotime($subscription->created_at)) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
