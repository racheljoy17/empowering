import mysql.connector
import serial

# Connect to MySQL database
db_connection = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="empoweringhomes"
)

# Create cursor
cursor = db_connection.cursor()

# Open serial port
ser = serial.Serial('COM3', 9600) # Adjust port and baud rate as needed

try:
    while True:
        # Read data from Arduino
        data = ser.readline().decode().strip()

        # Parse data (assuming it's comma-separated)
        values = data.split(',')

        # Insert data into MySQL database
        sql = "INSERT INTO data (voltage, current, watt, kwatt, kwh) VALUES (%d, %d, %d, %d, %d)"
        cursor.execute(sql, values)
        db_connection.commit()

finally:
    # Close serial port and database connection
    ser.close()
    cursor.close()
    db_connection.close()