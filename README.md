# ReKnee
FYP - Smart Knee Rehabilitation Assisting Device For Post Surgery Conditions

A smart, wearable solution designed to assist patients in knee rehabilitation post-surgery, specifically targeting the early stages of ACL rehabilitation. The device integrates Inertial Measurement Units (IMUs) with a user-friendly mobile application to provide real-time feedback on knee movements, track exercise progress, and offer guidance throughout the rehabilitation process.

## Project Overview

The Smart Knee Rehabilitation Assisting Device is a functional prototype that combines hardware and software components to help patients perform their rehabilitation exercises correctly and efficiently. The system includes:

- **Wearable Hardware**: The device uses two MPU6050 IMU sensors attached to a motion control knee guard to monitor knee joint movements. These sensors are connected to an ESP32 microcontroller that processes data in real-time and transmits it via Wi-Fi.
- **Mobile Application**: A mobile app built using Flutter provides a comprehensive interface for patients to follow exercise instructions, receive real-time feedback on their performance, and track their rehabilitation progress. The app supports exercises for the first week of ACL rehabilitation, including active-assisted extension, passive flexion, straight leg raises, and heel slides.

## Key Features

- **Real-Time Knee Angle Measurement**: The device accurately measures knee angles during exercises and provides immediate feedback via the mobile app.
- **Step-by-Step Exercise Instructions**: The app includes detailed instructions and video tutorials for each exercise, ensuring users understand and perform exercises correctly.
- **Progress Tracking**: Tracks repetitions, sets, and exercise duration, offering valuable insights for both patients and therapists.
- **Daily and Weekly Performance Analysis**: The app provides an analysis of key metrics such as maximum knee angles achieved and completion percentages of prescribed exercises.
- **User-Friendly Interface**: Developed using Flutter, the app is intuitive and easy to navigate, designed to enhance user engagement and adherence to rehabilitation protocols.

## Hardware Components

- **IMU Sensors (MPU6050)**: Measures knee joint movements and transmits data to the ESP32 microcontroller.
- **ESP32 Microcontroller**: Processes sensor data and handles communication with the mobile app via Wi-Fi.
- **Motion Control Knee Guard**: Serves as the mounting platform for the sensors, ensuring stability and accurate measurement during exercises.

## Software Components

- **Front-End**: The mobile app was developed using Flutter, providing a cross-platform solution with a responsive and interactive user interface.
- **Back-End**: Powered by PHP, the backend handles data processing, application logic, and integration with the sensors. It also manages user data and progress tracking in a MySQL database.
