#include <Ethernet.h>
#include <SPI.h>

byte mac[] = { 0x90, 0xA2, 0xDA, 0x00, 0x6F, 0x04 }; // RESERVED MAC ADDRESS
EthernetClient client;

String data;
String v, c, e;

void setup() { 
  Serial.begin(9600);

  if (Ethernet.begin(mac) == 0) {
    Serial.println("Failed to configure Ethernet using DHCP"); 
  }

  data = "";
}

void loop(){

  v = random(40, 50);
  c = random(20, 35);
  e = random(400, 600);


  data = "volt=" + v + "&corr=" + c + "&energ=" + e;

  if (client.connect("172.16.40.108",80)) { // REPLACE WITH YOUR SERVER ADDRESS
    client.println("POST /add.php HTTP/1.1"); 
    client.println("Host: 172.16.40.108"); // SERVER ADDRESS HERE TOO
    client.println("Content-Type: application/x-www-form-urlencoded"); 
    client.print("Content-Length: "); 
    client.println(data.length()); 
    client.println(); 
    client.print(data); 
  } 

  if (client.connected()) { 
    client.stop();  // DISCONNECT FROM THE SERVER
  }

  Serial.println(data);

  delay(5000); // WAIT FIVE MINUTES BEFORE SENDING AGAIN
}



