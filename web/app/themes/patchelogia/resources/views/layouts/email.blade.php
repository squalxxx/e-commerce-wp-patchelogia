<!DOCTYPE html>

<html lang="ru">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>{{ $siteName ?? get_bloginfo('name') }}</title>
    </head>

    <body style="margin: 0; padding: 0; background-color: #f4f4f4; font-family: Arial, Helvetica, sans-serif;">
        <table
            cellpadding="0"
            cellspacing="0"
            role="presentation"
            style="background-color: #f4f4f4; padding: 30px 0;"
            width="100%"
        >
            <tr>
                <td align="center">
                    <table
                        cellpadding="0"
                        cellspacing="0"
                        role="presentation"
                        style="background-color: #ffffff; border-radius: 8px; overflow: hidden; max-width: 600px; width: 100%;"
                        width="600"
                    >
                        <tr>
                            <td style="background-color: #111111; padding: 24px 32px;">
                                <a href="{{ home_url() }}" style="text-decoration: none;">
                                    <span style="color: #ffffff; font-size: 20px; font-weight: bold;">
                                        {{ $siteName ?? get_bloginfo('name') }}
                                    </span>
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td style="padding: 32px; color: #333333; font-size: 15px; line-height: 1.6;">
                                @yield('content')
                            </td>
                        </tr>

                        <tr>
                            <td style="background-color: #f9f9f9; padding: 20px 32px; border-top: 1px solid #eeeeee;">
                                <p style="margin: 0; color: #999999; font-size: 12px; line-height: 1.5;">
                                    Это письмо отправлено с сайта
                                    <a href="{{ home_url() }}" style="color: #999999;">{{ home_url() }}</a>.
                                    Если вы не запрашивали это письмо, просто проигнорируйте его.
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>

</html>
