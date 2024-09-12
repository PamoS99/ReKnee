#include <Wire.h>
#include <WiFi.h>
#include <HTTPClient.h>

// MPU addresses
const int MPU1_ADDRESS = 0x68;
const int MPU2_ADDRESS = 0x69;

float RateRoll1, RatePitch1, RateYaw1;
float RateRoll2, RatePitch2, RateYaw2;
float RateCalibrationRoll = 0, RateCalibrationPitch = 0, RateCalibrationYaw = 0;
float AccX, AccY, AccZ;
float AngleRoll1, AnglePitch1;
float AngleRoll2, AnglePitch2;
uint32_t LoopTimer;
float CompAngleRoll1 = 0, CompAnglePitch1 = 0;
float CompAngleRoll2 = 0, CompAnglePitch2 = 0;
float diff = 0, diff_new = 0;
const char* ssid = "Pamo";
const char* password = "drawing99";
String serverName = "http://skr.pentaone.co/getdata.php";
unsigned long previousMillis = 0;
const long interval = 3000;

void initWiFi() {
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);
  Serial.println("");
  Serial.print("Connecting to WiFi...");
  while (WiFi.status() != WL_CONNECTED) {
    Serial.print(".");
    delay(1000);
  }
  Serial.println("");
  Serial.println(WiFi.localIP());
}

void gyro_signals(int MPU_ADDRESS, float &RateRoll, float &RatePitch, float &RateYaw, float &AngleRoll, float &AnglePitch) {
  Wire.beginTransmission(MPU_ADDRESS);
  Wire.write(0x1A);
  Wire.write(0x05);
  Wire.endTransmission();
  Wire.beginTransmission(MPU_ADDRESS);
  Wire.write(0x1C);
  Wire.write(0x10);
  Wire.endTransmission();
  Wire.beginTransmission(MPU_ADDRESS);
  Wire.write(0x3B);
  Wire.endTransmission();
  Wire.requestFrom(MPU_ADDRESS, 6);
  int16_t AccXLSB = Wire.read() << 8 | Wire.read();
  int16_t AccYLSB = Wire.read() << 8 | Wire.read();
  int16_t AccZLSB = Wire.read() << 8 | Wire.read();
  Wire.beginTransmission(MPU_ADDRESS);
  Wire.write(0x1B);
  Wire.write(0x08);
  Wire.endTransmission();
  Wire.beginTransmission(MPU_ADDRESS);
  Wire.write(0x43);
  Wire.endTransmission();
  Wire.requestFrom(MPU_ADDRESS, 6);
  int16_t GyroX = Wire.read() << 8 | Wire.read();
  int16_t GyroY = Wire.read() << 8 | Wire.read();
  int16_t GyroZ = Wire.read() << 8 | Wire.read();
  RateRoll = (float)GyroX / 65.5;
  RatePitch = (float)GyroY / 65.5;
  RateYaw = (float)GyroZ / 65.5;
  AccY = (float)AccYLSB / 4096;
  AccZ = (float)AccZLSB / 4096;
  AccX = (float)AccXLSB / 4096;
  AngleRoll = atan2(AccY,  AccZ) * 180/PI;
  AnglePitch = atan2(AccY, sqrt(AccX*AccX + AccZ*AccZ)) * 180/PI;
}

void setup() {
  Serial.begin(115200);
  initWiFi();
  pinMode(13, OUTPUT);
  digitalWrite(13, HIGH);
  Wire.setClock(400000);
  Wire.begin();
  delay(250);
  Wire.beginTransmission(MPU1_ADDRESS);
  Wire.write(0x6B);
  Wire.write(0x00);
  Wire.endTransmission();
  Wire.beginTransmission(MPU2_ADDRESS);
  Wire.write(0x6B);
  Wire.write(0x00);
  Wire.endTransmission();
  for (int RateCalibrationNumber = 0; RateCalibrationNumber < 2000; RateCalibrationNumber++) {
    gyro_signals(MPU1_ADDRESS, RateRoll1, RatePitch1, RateYaw1, AngleRoll1, AnglePitch1);
    RateCalibrationRoll += RateRoll1;
    RateCalibrationPitch += RatePitch1;
    RateCalibrationYaw += RateYaw1;
    gyro_signals(MPU2_ADDRESS, RateRoll2, RatePitch2, RateYaw2, AngleRoll2, AnglePitch2);
    RateCalibrationRoll += RateRoll2;
    RateCalibrationPitch += RatePitch2;
    RateCalibrationYaw += RateYaw2;
    delay(1);
  }
  RateCalibrationRoll /= 4000;
  RateCalibrationPitch /= 4000;
  RateCalibrationYaw /= 4000;
  LoopTimer = micros();
}


void loop() {
  gyro_signals(MPU1_ADDRESS, RateRoll1, RatePitch1, RateYaw1, AngleRoll1, AnglePitch1);
  RateRoll1 -= RateCalibrationRoll;
  RatePitch1 -= RateCalibrationPitch;
  RateYaw1 -= RateCalibrationYaw;
  float dt = 0.004;
  float alpha = 0.98;
  CompAngleRoll1 = alpha * (CompAngleRoll1 + RateRoll1 * dt) + (1 - alpha) * AngleRoll1;
  CompAnglePitch1 = alpha * (CompAnglePitch1 + RatePitch1 * dt) + (1 - alpha) * AnglePitch1;

  gyro_signals(MPU2_ADDRESS, RateRoll2, RatePitch2, RateYaw2, AngleRoll2, AnglePitch2);
  RateRoll2 -= RateCalibrationRoll;
  RatePitch2 -= RateCalibrationPitch;
  RateYaw2 -= RateCalibrationYaw;
  CompAngleRoll2 = alpha * (CompAngleRoll2 + RateRoll2 * dt) + (1 - alpha) * AngleRoll2;
  CompAnglePitch2 = alpha * (CompAnglePitch2 + RatePitch2 * dt) + (1 - alpha) * AnglePitch2;

  diff = 180 + CompAnglePitch1 + CompAnglePitch2;
  // if (diff > 180){
  //   diff_new = diff - 180; 
  // }else{
  //   diff_new = diff;
  // }

  // Ensure the loop runs at a consistent frequency
  while (micros() - LoopTimer < 4000);
  LoopTimer = micros();

  // Get the current time
  unsigned long currentMillis = millis();

  // Check if 3 seconds have passed
  if (currentMillis - previousMillis >= interval) {
    previousMillis = currentMillis;
  
    Serial.print("MPU1 Roll Angle [°]: ");
    Serial.print(CompAngleRoll1);
    // Serial.print(" MPU1 Pitch Angle [°]: ");
    // Serial.print(RatePitch1);
    Serial.print(" MPU2 Roll Angle [°]: ");
    Serial.print(CompAngleRoll2);


    // Only send data if WiFi is connected
    if (WiFi.status() == WL_CONNECTED) {
      HTTPClient http;
      String serverPath = serverName + "?angle1=" + diff + "&angle2=" + CompAnglePitch1;
      http.begin(serverPath.c_str());

      // Send HTTP GET request
      int httpResponseCode = http.GET();

      if (httpResponseCode > 0) {
        Serial.print("HTTP Response code: ");
        Serial.println(httpResponseCode);
      } else {
        Serial.print("Error code: ");
        Serial.println(httpResponseCode);
      }

      // Free resources
      http.end();
    }
  }
}
