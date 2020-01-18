<?php

/* @var $this yii\web\View */

$this->title = 'Scan Kartu RFID';
$this->params['breadcrumbs'][] = $this->title;
?>

<script src="<?php echo Yii::$app->request->baseUrl; ?>/js/mqttws31ori.js"></script>

<script type="text/javascript">
    var undeliveredMessages = [];
    //var client = new Paho.MQTT.Client("103.27.207.134:1883", "112233");
    var client = new Paho.MQTT.Client("103.27.207.134", Number(8083), "laptop_dany");
    //var client = new Paho.MQTT.Client("m20.cloudmqtt.com", Number(37251), "426ea1b8-a095-4ec2-b641-905297f0963a");
    client.onMessageArrived = onMessageArrived;
    client.onMessageDelivered = onMessageDelivered;

    function init() {
        console.log("...starting...");
        client.connect({
            useSSL: false,
            userName: "admin",
            password: "public",
            onSuccess: createDevice
        });
    }

    function createDevice() {
        console.log("subscribe tabsence-83758743-admin");
        client.subscribe("tabsence-83758743-admin");
        client.subscribe("@hum,");
        client.subscribe("@lux,");
    }

    function onMessageArrived(message) {
        console.log('Received operation "' + message.payloadString + '"');
        gaugeUpdate(message);
        // log('Received operation "' + message.qos + "/" + message.duplicate + "/" + message.retained + "/" + message.destinationName + "/" + message.payloadString + '"');
        log(message.payloadString);
    }

    function gaugeUpdate(message) {
        meteran.setValue(message);
    }

    function onMessageDelivered(message) {
        log('Message "' + message.payloadString + '" delivered');
        var undeliveredMessage = undeliveredMessages.pop();
        if (undeliveredMessage.onMessageDeliveredCallback) {
            undeliveredMessage.onMessageDeliveredCallback();
        }
    }

    function publish(topic, message, onMessageDeliveredCallback) {
        message = new Paho.MQTT.Message(message);
        message.destinationName = topic;
        message.qos = 2;
        undeliveredMessages.push({
            message: message,
            onMessageDeliveredCallback: onMessageDeliveredCallback
        });
        client.send(message);
    }

    function log(message) {
        // document.getElementById('logger').insertAdjacentHTML('beforeend', '<div>' + message + '</div>');
        var arr = message.split(",");
        var jenisAbsen = "Lupa tekan tombol";
        var namaKartu = "";

        if (arr[1] === "B1") {
            jenisAbsen = "Absen masuk";
        } else if (arr[1] === "B2") {
            jenisAbsen = "Absen ijin keluar sementara";
        } else if (arr[1] === "B3") {
            jenisAbsen = "Absen kembali dari ijin keluar sementara";
        } else if (arr[1] === "B4") {
            jenisAbsen = "Absen pulang";
        } else {
            jenisAbsen = "Tombol tidak diketahui";
        }

        if (arr[0] === "215231098139") {
            namaKartu = "Kartu B";
        } else if (arr[0] === "39018052021") {
            namaKartu = "Kartu A";
        } else {
            namaKartu = arr[0];
        }

        // log(arr[0] + " | Jenis Absen : " + jenisAbsen);

        var color = ["bg-gray", "bg-lime", "bg-orange", "bg-teal", "bg-fuchsia", "bg-maroon", "bg-navy", "bg-aqua", "bg-red", "bg-blue", "bg-yellow", "bg-green", "bg-purple",];
        var i = Math.floor((Math.random() * color.length) + 1);
        var parent = document.getElementById('logger');
        var days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        var d = new Date();
        var datefull = days[d.getDay()] + ", " + d.getDate() + " " + months[d.getMonth()] + " " + d.getFullYear();
        var hoursFull = d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds();
        // parent.insertAdjacentHTML('beforeend', '<div>' + arr[0] + " | Jenis Absen : " + jenisAbsen + '</div>');

        parent.insertAdjacentHTML('afterbegin', '<div class="col-md-12 col-sm-6 col-xs-12">\n' +
            '                <div class="info-box ' + color[i] + '">\n' +
            '                    <span class="info-box-icon"><img class="img-circle" src="<?php echo Yii::$app->request->baseUrl; ?>/repository/users/default.png"\n' +
            '                                                     width="60" alt="User Avatar"></span>\n' +
            '\n' +
            '                    <div class="info-box-content">\n' +
            '                        <span class="info-box-text">' + jenisAbsen + '</span>\n' +
            '                        <span class="info-box-number">' + namaKartu + '</span>\n' +
            '\n' +
            '                        <div class="progress">\n' +
            '                            <div class="progress-bar" style="width: 100%"></div>\n' +
            '                        </div>\n' +
            '                        <span class="progress-description">\n' + datefull + ' | ' + hoursFull +
            '                  </span>\n' +
            '                    </div>\n' +
            '                    <!-- /.info-box-content -->\n' +
            '                </div>\n' +
            '            </div>')


        var box = document.createElement("DIV");
        box.className = "col-md-12 col-sm-6 col-xs-12";
        var infobox = document.createElement("DIV");
        infobox.className = "info-box bg-green";
        var boxcontent = document.createElement("DIV");
        boxcontent.className = "info-box-content";
        var spanText = document.createElement("SPAN");
        spanText.className = "info-box-text";
        var spanNum = document.createElement("SPAN");
        spanNum.className = "info-box-number";
        var spanDate = document.createElement("SPAN");
        spanDate.className = "progress-description"

        var dateText = document.createTextNode(datefull);
        spanDate.appendChild(dateText);
        var numText = document.createTextNode(arr[0]);
        spanNum.appendChild(numText);
        var textText = document.createTextNode(jenisAbsen);
        spanText.appendChild(textText);
        //
        // boxcontent.appendChild(textText);
        //
        // infobox.appendChild(boxcontent);
        //
        // box.appendChild(infobox);
        //
        // parent.appendChild(box);


    }
</script>

<body onload="init();">

<div class="col-md-12">

    <div class="box box-primary">

        <div id="mainbody" class="box-body">

            <div class="callout callout-info">
                <p>Silakan scan kartu keanggotaan. Jika berurutan, lakukan secara berurutan dan tunggu beberapa detik
                    setelahnya</p>
            </div>

        </div>

        <div id="footer" class="box-body">
            <div class="col-sm-12 col-md-12">
                <div class="box box-solid">
                    <div class="box-body">
                        <h4 style="background-color:#f7f7f7; font-size: 12px; text-align: center; padding: 2px 10px; margin-top: 0;">
                            LOG NOTES
                        </h4>

                        <div id="logger"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>




