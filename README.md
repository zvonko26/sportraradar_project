# Sports Event Calendar

This is a **Sports Event Calendar** application that allows users to view, add, and filter sports events based on the sport, date, and team. The app supports a video background on the homepage and a form to add new events.

## Features

- **View Events**: Display sports events in a user-friendly format with details like date, time, teams, and venue.
- **Add Events**: Add new events to the calendar through a simple form.
- **Search & Filter**: Search events by keyword and filter by sport or date.
- **Responsive Design**: The application is responsive and works across devices, including desktop and mobile.

## Technologies Used

- **HTML5** for the structure of the web page.
- **CSS3** for styling and layout.
- **Bootstrap** for responsive design and pre-built components.
- **PHP** for server-side handling of events.
- **MySQL** for storing event data.

## Getting Started

Follow these steps to get a local copy up and running:

### Prerequisites

1. Install a local server environment like **XAMPP** or **MAMP** to run PHP.
2. Set up a **MySQL database** for storing event data (details below).

CREATE DATABASE sports_calendar;

USE sports_calendar;

CREATE TABLE sports (
    sport_id INT AUTO_INCREMENT PRIMARY KEY,
    sport_name VARCHAR(255) NOT NULL
);

CREATE TABLE venues (
    venue_id INT AUTO_INCREMENT PRIMARY KEY,
    venue_name VARCHAR(255) NOT NULL
);

CREATE TABLE events (
    event_id INT AUTO_INCREMENT PRIMARY KEY,
    event_date DATE NOT NULL,
    event_time TIME NOT NULL,
    sport_id INT,
    team_1 VARCHAR(255) NOT NULL,
    team_2 VARCHAR(255) NOT NULL,
    venue_id INT,
    FOREIGN KEY (sport_id) REFERENCES sports(sport_id),
    FOREIGN KEY (venue_id) REFERENCES venues(venue_id)
);


### Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/zvonko26/sportraradar_project.git
