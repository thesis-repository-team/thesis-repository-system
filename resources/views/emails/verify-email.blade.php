<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Verify Your Email</title>
</head>

<body style="margin: 0; padding: 0; background-color: #f4f6f8; font-family: Arial, sans-serif;">

    <div style="max-width: 600px; margin: 40px auto; background: #ffffff; padding: 40px; border-radius: 10px;">

        <!-- University Logo -->
        <div style="text-align: center; margin-bottom: 25px;">
            <img
                src="{{ asset('image/Small LU Logo.png') }}"
                alt="Life University Logo"
                style="width: 100px; height: auto;"
            >
        </div>

        <!-- Title -->
        <h2 style="text-align: center; color: #111827;">
            Life University
        </h2>

        <h3 style="text-align: center; color: #374151;">
            Thesis Repository
        </h3>

        <!-- Message -->
        <p style="color: #374151; font-size: 15px;">
            Hello {{ $user->name ?? $user->username }},
        </p>

        <p style="color: #374151; font-size: 15px; line-height: 1.6;">
            Thank you for registering with the Life University Thesis Repository.
        </p>

        <p style="color: #374151; font-size: 15px; line-height: 1.6;">
            Please verify your email address to activate your account.
        </p>

        <!-- Button -->
        <div style="text-align: center; margin: 30px 0;">
            <a
                href="{{ $url }}"
                style="
                    display: inline-block;
                    padding: 12px 25px;
                    background-color: #0000a0;
                    color: #ffffff;
                    text-decoration: none;
                    border-radius: 6px;
                    font-size: 15px;
                "
            >
                Verify Email Address
            </a>
        </div>

        <p style="color: #6b7280; font-size: 13px; line-height: 1.5;">
            If you did not create this account, no further action is required.
        </p>

        <p style="color: #374151; font-size: 14px; margin-top: 30px;">
            Regards,<br>
            <strong>Life University Thesis Repository</strong>
        </p>

    </div>

</body>
</html>