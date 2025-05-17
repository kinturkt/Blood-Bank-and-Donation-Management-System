<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>News Ticker</title>
  <style>
    .news {
      display: flex;
      align-items: center;
      background-color: #347fd0;
      color: white;
      height: 50px;
      overflow: hidden;
      border-radius: 4px;
      box-shadow: inset 0 -15px 30px rgba(10,4,60,0.4), 0 5px 10px rgba(10,20,100,0.5);
      font-family: 'Segoe UI', sans-serif;
    }

    .news-label {
      background-color: #F60F0F;
      height: 100%;
      width: 130px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      font-size: 16px;
      flex-shrink: 0;
    }

    .ticker-wrap {
      position: relative;
      overflow: hidden;
      width: 100%;
    }

    .ticker {
      display: inline-block;
      white-space: nowrap;
      padding-left: 100%;
      animation: ticker 15s linear infinite;
    }

    @keyframes ticker {
      0% { transform: translateX(0); }
      100% { transform: translateX(-100%); }
    }

    @media screen and (max-width: 600px) {
      .news-label {
        font-size: 12px;
        width: 100px;
      }

      .ticker {
        font-size: 14px;
      }
    }
  </style>
</head>
<body>

<div class="news">
  <div class="news-label">Latest Updates</div>
  <div class="ticker-wrap">
    <div class="ticker">
A blood donation camp will be organized in collaboration with the Blood Bank & Donation Management System on <b>06/10/2021 at Community Centre.</b> Come and be a part of this noble cause :)
</div>

</body>
</html>