<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Survey Jingga</title>
    <link
      href="https://fonts.googleapis.com/css?family=Roboto"
      rel="stylesheet"
      type="text/css"
    />
  </head>
  <body>
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
      <tr>
        <td>
          <table
            align="center"
            border="0"
            cellpadding="0"
            cellspacing="0"
            width="600"
          >
            <tr>
              <td bgcolor="#ffffff">
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                  <tr>
                    <td
                      style="
                        color: #153643;
                        font-family: Arial, sans-serif;
                        padding-bottom: 20px;
                      "
                    >
                      <p>Hi {{$mailData['name'] }},</p>
                      <p>
                        Terimakasih sudah menggunakan layanan kami.
                      </p>
                      <p>
                        Jadwal survey online anda akan dimulai <strong>Besok Pukul {{$mailData['hours'] }}</strong>
                      </p>
                      <p>
                        Silakan klik link dibawah untuk memulai zoom meeting.
                      </p>
                    </td>
                  </tr>
                  <tr>
                    <td align="center">
                      <table
                        cellspacing="0"
                        cellpadding="0"
                        border="0"
                        bgcolor="#F4A238"
                        style="border-radius: 25px"
                      >
                        <tr>
                          <td
                            height="45"
                            style="
                              font-size: 18px;
                              padding: 0 15px;
                              font-family: Arial, sans-serif;
                              font-weight: bold;
                            "
                          >
                          <a style="text-decoration: none ;color:#fff" href="{{$mailData['link']}}">Klik Disini</a>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td
                      style="
                        color: #153643;
                        font-family: Arial, sans-serif;
                        border-bottom: 1px solid #ccc;
                        padding-bottom: 30px;
                        padding-top: 20px;
                      "
                    >
                      <p>Thanks, <br />Jingga Teknologi</p>
                    </td>
                  </tr>
                  <tr>
                    <td
                      style="
                        padding: 20px 0 30px 0;
                        border-bottom: 1px solid #ccc;
                      "
                    >
                      <table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                          <td>
                            <table align="left" width="300">
                              <tr>
                                <td
                                  valign="top"
                                  style="
                                    color: #153643;
                                    font-family: Arial, sans-serif;
                                    color: #153643;
                                    font-family: Arial, sans-serif;
                                  "
                                >
                                  <h2>Questions?</h2>
                                  Contact Us at
                                  <a
                                    href="mailto:help@xpedius.com"
                                    style="color: #57BAF7"
                                    >admin@admin@jtechsurvey.com</a
                                  >
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </body>
</html>