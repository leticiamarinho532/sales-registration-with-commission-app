<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="x-apple-disable-message-reformatting">
        <title></title>
        <style>
        table, td, div, h1, p {font-family: Arial, sans-serif;}
        </style>
    </head>
    <body style="margin:0;padding:0;">
        <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
            <tr>
                <td align="center" style="padding:1%;border:2px solid #c2bcbc !important;font-size: 40px;">
                    Olá, {{ $this->seller->name }}! Chegou seu relatório diário de Vendas!
                </td>
            </tr>
            <tr>
                <td style="padding:5px;text-align: center;font-size: 20px;color: #060257;">
                    Vendas realizadas no dia de hoje!
                </td>
            </tr>
            <tr>
                <td style="padding:5px;text-align: center;font-size: 20px;color:#060257;">
                    Somatório: R$ {{ $this->sumAllSalesDay }}
                </td>
            </tr>
        </table>
    </body>
</html>