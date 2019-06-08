<!DOCTYPE html>
<html>
<head>
<style>
    p{
        font-family:"Times New Roman";
        font-size:20px;
    }
    .center{
        text-align:center;
    }
    .btn-verifikasi{
      background-color: black;
      padding: 10px;
      color : white;
      text-decoration: none;
      border-radius: 10px;
    }
    .number{
      text-decoration: none;
      border-radius: 10px;
    }
    </style>
</head>
<body>
Hello <i>{{ $data['user']->userable->name }}</i>,
<div class="center">
  <p>
      Selamat Datang di <a href="{{ env('BASE_URL') }}">kasiertansi.zitech.id</a> dan
      Terimakasih Telah Bergabung dengan kami
  </p>
  <p>Untuk mengaktifkan akun anda klik tombol dibawah</p>
  <a href="{{ $data['url'] }}"
  class="btn-verifikasi">Verifikasi</a>
  <p>
    Untuk membantu kami agar kami terus memberikan yang terbaik untuk anda silahkan hubungi Customer Service kami di
    <a class="number" href="https://api.whatsapp.comsend?phone=6288229704493&text=Halo%20saya%20ingin%20bertanya-tanya%20tentang%20layanan%20dari%20zitech">
    +6288229704493
    </a>
  </p>
</div>


Thank You,
<br/>
<i>zitech.id</i>

</table>
</body>
</html>
