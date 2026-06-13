# Observer Pattern Simulation in Pure PHP

This project is a simple Event-Driven system built with pure PHP using OOP principles.
It demonstrates the Observer Design Pattern in a real-world scenario where a file download triggers multiple independent
observers such as logging, analytics, and counters.

### Note that no actual file is downloaded, This is just a test

🌐 [Visit Demo](https://php-observer.kazembeygi.com)

---

## How it works

1️⃣ User clicks download button in `index.php`

2️⃣ `FileDownload` use case is triggered

3️⃣ A `DownloadEvent` is created containing:
- file id
- file slug
- file name
- user IP
- timestamp

4️⃣ Event is passed to Subject (`FileDownload`)

5️⃣ All registered observers are notified:
- Analytics → tracks event
- Counter → increases download count
- Logger → saves log

6️⃣ Each observer reacts independently without affecting others

---

## Design Pattern Used

### Observer Pattern

- Subject: UseCases/FileDownload.php
- Event: Events/DownloadEvent.php
- Observers:
    - Observers/Logger.php
    - Observers/Counter.php
    - Observers/Analytics.php

🟡 The Subject does not know anything about observers.  
🟡 It only broadcasts an event, and observers react independently.

---

Implemented by Hesam kazembeygi

📌 [My Website](https://kazembeygi.com)

📌 [My LinkedIn](https://www.linkedin.com/in/hessam-kazembeygi)