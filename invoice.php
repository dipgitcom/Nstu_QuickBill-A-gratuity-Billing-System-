<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Bill</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e9ecef;
        }

        .document {
            max-width: 900px;
            margin: 30px auto;
            padding: 30px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2px solid #17a2b8;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .logo {
            width: 80px;
        }

        .university-info h1 {
            font-size: 22px;
            margin: 0;
            color: #343a40;
        }

        .university-info h2 {
            font-size: 18px;
            margin: 5px 0;
            color: #6c757d;
        }

        .contact-info {
            font-size: 14px;
            color: #6c757d;
        }

        .title {
            text-align: center;
            font-size: 20px;
            margin: 20px 0;
            color: #495057;
        }

        .subtitle {
            text-align: center;
            font-size: 16px;
            color: #6c757d;
            margin-bottom: 30px;
        }

        .exam-info {
            font-size: 16px;
            line-height: 1.8;
        }

        .exam-info strong {
            color: #495057;
        }

        .table-container {
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .table thead th {
            background-color: #17a2b8;
            color: #ffffff;
            text-align: center;
        }
        .table tfoot td {
            font-weight: bold;
        }
        .header-title {
            text-align: center;
            margin-bottom: 20px;
            color: #343a40;
        }
        .table-bordered {
            border: 1px solid #dee2e6;
        }
        .table-bordered th, .table-bordered td {
            border: 1px solid #dee2e6;
        }
        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #6c757d;
            text-align: center;
        }

        .btn-custom {
            background-color: #17a2b8;
            border-color: #17a2b8;
            color: #ffffff;
            font-weight: bold;
            font-size: 16px;
        }

        .btn-custom:hover {
            background-color: #138496;
            border-color: #117a8b;
        }

        .total-row {
            background-color: #e9ecef;
            font-weight: bold;
        }
        @media print {
        .btn-custom {
            display: none;
        }
    }
    </style>
</head>
<body>
    <div class="container">
        <div class="document">
            <div class="header">
                <img src="../images/nstulogo.png" alt="University Logo" class="logo">
                <div class="university-info text-center">
                    <h1>নোয়াখালী বিজ্ঞান ও প্রযুক্তি বিশ্ববিদ্যালয়</h1>
                    <h2>Noakhali Science and Technology University</h2>
                    <p>নোয়াখালী-৩৮১৪</p>
                </div>
                <div class="contact-info text-right">
                    <p>Mobile: 01811 150935</p>
                    <p>E-mail: info@nstu.edu.bd</p>
                    <p>Website: www.nstu.edu.bd</p>
                </div>
            </div>

            <h3 class="title">পরীক্ষা নিয়মকক্ষ দপ্তর</h3>
            <p class="subtitle">(শ্রেণীর বিভাগ, বর্ষ ও টার্মের জন্য আবেদন বা অনুমতি গ্রহণ আবশ্যক হবে)</p>

            <div class="exam-info">
                <p><strong>বিলের রসিদ নম্বর:</strong> ___________________</p>
                <p>
                    (পরীক্ষার ফল প্রকাশের এক মাসের মধ্যে নির্ধারিত পরীক্ষার পরিষদের অনুমতির মাধ্যমে পরীক্ষার রসিদ
                    অফিসে প্রদান করতে হবে।)
                </p>
                <p><strong>পরীক্ষার্থীর নাম:</strong> Dr.Nuruzzaman BHuiyan</p>
                <p><strong>পরিচয় পত্রের নং:</strong>Assistant Professor,IIT, NSTU</p>
                <p><strong>যে পরীক্ষার অনুমতি:</strong> ইঞ্জিনিয়ারিং অফ ইনস্টিটিউট টেক</p>
                <p><strong>বর্ষ:</strong> ২&nbsp;&nbsp;&nbsp;&nbsp;<strong>টার্ম:</strong> ২</p>
                <p><strong>শিক্ষাবর্ষ:</strong> 2018-2019</p>
                <p><strong>পরীক্ষার তারিখ:</strong> ১২/১২/২০২৩</p>
            </div>

            <p class="footer">
                **অনুগ্রহ করে নিশ্চিত করুন যে প্রদত্ত তথ্য এবং খরচ সঠিক।
            </p>
            <div class="container">
    <div class="table-container">
        <h3 class="header-title">বিল বিবরণী</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-left">বিবরণ</th>
                    <th class="text-center">পরিমাণ</th>
                    <th class="text-right">টাকা</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="3"><strong>১. প্রশ্নপত্র মূল্যঃ</strong></td>
                </tr>
                <tr>
                    <td>ক. প্রতি ৬ ঘণ্টার পরীক্ষার Information Security বিষয় CSE 2206 কোর্স কোড</td>
                    <td class="text-center">1</td>
                    <td class="text-right">1,350</td>
                </tr>
                <tr>
                    <td>খ. প্রতি ৬ ঘণ্টার পরীক্ষার Software Requirement Specification & Analysis বিষয় SE 2209 কোর্স</td>
                    <td class="text-center">1</td>
                    <td class="text-right">1,350</td>
                </tr>
                <tr>
                    <td colspan="3"><strong>২. প্রশ্নপত্র সমন্বয়করণ/সহায়কঃ</strong></td>
                </tr>
                <tr>
                    <td>Information Security Lab CSE 2201, CSE 2206, CSE 2207, SE 2209</td>
                    <td class="text-center">-</td>
                    <td class="text-right">2,000</td>
                </tr>
                <tr>
                    <td colspan="3"><strong>৩. স্টাফ স্টেশ / স্টাফ মূল্যায়নঃ</strong></td>
                </tr>
                <tr>
                    <td>SE 2209: Software Requirement Specification & Analysis</td>
                    <td class="text-center">33 × 3</td>
                    <td class="text-right">3,960</td>
                </tr>
                <tr>
                    <td colspan="3"><strong>৪. উত্তরপত্র মূল্যায়নঃ</strong></td>
                </tr>
                <tr>
                    <td>ক. 33 টি ২ ঘণ্টার পরীক্ষার Information Security বিষয় CSE 2206 কোর্স কোড</td>
                    <td class="text-center">33 × 90</td>
                    <td class="text-right">2,970</td>
                </tr>
                <tr>
                    <td>খ. 36 টি ২ ঘণ্টার পরীক্ষার Software Requirement Specification & Analysis বিষয় SE 2209</td>
                    <td class="text-center">36 × 90</td>
                    <td class="text-right">3,240</td>
                </tr>
                <tr>
                    <td colspan="3"><strong>৫. ব্যবহারিক পরীক্ষাঃ</strong></td>
                </tr>
                <tr>
                    <td>ক. 2020 ফাল - Y2-T2 Software Requirement Specification & Analysis Lab বিষয়ে ১ দিন</td>
                    <td class="text-center">3 × 1200</td>
                    <td class="text-right">3,600</td>
                </tr>
                <tr>
                    <td>খ. 2020 ফাল - Y2-T2 Information Security Lab বিষয়ে ১ দিন</td>
                    <td class="text-center">3 × 1200</td>
                    <td class="text-right">3,600</td>
                </tr>
                <tr>
                    <td>গ. 2020 ফাল - Y2-T2 Database Management System - 1 Lab বিষয়ে ১ দিন</td>
                    <td class="text-center">3 × 1200</td>
                    <td class="text-right">3,600</td>
                </tr>
                <tr>
                    <td colspan="3"><strong>৬. মৌখিক পরীক্ষাঃ</strong></td>
                </tr>
                <tr>
                    <td>কোনো তথ্য নেই</td>
                    <td class="text-center">N/A</td>
                    <td class="text-right">-</td>
                </tr>
                <tr>
                    <td colspan="3"><strong>৭. পরীক্ষা কেন্দ্র পরিচালন ব্যয়ঃ</strong></td>
                </tr>
                <tr>
                    <td>34 টি পরীক্ষার জন্য</td>
                    <td class="text-center">34 × 50</td>
                    <td class="text-right">1,700</td>
                </tr>
                <tr>
                    <td colspan="3"><strong>৮. মডারেটর ও পরীক্ষক সম্মানী / সভাসদ</strong></td>
                </tr>
                <tr>
                    <td>ডাকমাশুল ও অন্যান্য ব্যয়</td>
                    <td class="text-center">-</td>
                    <td class="text-right">2,500</td>
                </tr>
                <tr>
                    <td>ফাইনাল পরীক্ষার প্রতিটি (CSE 2207)</td>
                    <td class="text-center">-</td>
                    <td class="text-right">200</td>
                </tr>
                <tr class="font-weight-bold">
                    <td colspan="2" class="text-right">মোট টাকা:</td>
                    <td class="text-right">30,070</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="certification mt-4">
        <p>প্রত্যয়ন করা যাছে যে, উপর্যুক্ত বিবরণী আমার জানামতে সঠিক। বিল পরিশোধ করা যেতে পারে।</p>
        <p>কথায়: <span style="text-decoration: underline;"></span></p>
        <br><br>
        <p>
            <strong>স্বাক্ষর (সীল সহ)</strong><br>
            পরীক্ষা পরিষদের সভাপতি<br>
            ইন্সটিটিউট অব ইনফরমেশন টেকনোলজি<br>
            বর্ষঃ ২, টার্মঃ ২
        </p>
        <br>
        <p>প্রত্যয়ন করা যাছে যে, অত্র বিলের টাকা পূর্বে গ্রহণ করা হয়নি। অতিরিক্ত কোন অর্থ উত্তোলন করলে ফেরত দিতে বাধ্য থাকব।</p>
        <p style="text-align:center"><strong>বিলসমূহ নিরীক্ষান্তে পরিশোধ করা যেতে পারে</strong></p>
        <br><br>
        <p>
            <strong>প্রাপকের স্বাক্ষর ও তারিখ</strong>
        </p>
        <table class="table table-borderless">
            <tbody>
                <tr>
                    <td><strong>অফিস সহকারী</strong><p>__________________</p></td><br>
                    <td><strong>সেকশন অফিসার / সহকারী পরীক্ষা নিয়ন্ত্রক</strong><p>_______________________________</p></td>
                    <td><strong>উপ পরীক্ষা নিয়ন্ত্রক</strong><p>__________________</p></td>
                    <td><strong>পরীক্ষা নিয়ন্ত্রক</strong><p>__________________</p></td>
                </tr>
            </tbody>
        </table>
        <br>
        <p><strong>হিসাব বিভাগের ব্যবহারের জন্য</strong></p>
        <p>পরীক্ষান্তে বর্ণিত পারিতোষিক বিল বাবদ ___________ কথায় (_) মাত্র পরিশোধ করা হলো।</p>
    </div>
</div>


</body>

    <div>
            <button class="btn btn-custom btn-block" onclick="printDocument()"><i class="fas fa-print"></i> Print Document</button>
        </div>
    </div>
<script>
        function printDocument() {
            window.print();
        }
    </script>
</html>
