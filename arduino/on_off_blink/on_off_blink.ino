#define LED 13

void setup() {
  Serial.begin(115200);
  pinMode(LED, OUTPUT);
}

void on()
{
  digitalWrite(LED, HIGH);
}
void off()
{
  digitalWrite(LED, LOW);
}
bool st = 0;
void blink()
{
  digitalWrite(LED, st);
  delay(100);
  st = !st;
}

int action = 1;
void loop() {
  if (Serial.available() > 0)
  {
    action = Serial.read();
    while (Serial.available() > 0)
      Serial.read();
  }
  switch (action)
  {
    case (1):
      off();
      break;
    case (2):
      on();
      break;
    case (3):
      blink();
      break;
  }
}
