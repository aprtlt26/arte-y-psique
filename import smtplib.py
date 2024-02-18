import smtplib
from email.mime.text import MIMEText
from email.mime.multipart import MIMEMultipart

def send_email():
    smtp_server = 'smtp.example.com'
    smtp_port = 587
    smtp_username = 'tu_correo@example.com'
    smtp_password = 'tu_contraseña'
    to_email = 'destinatario@example.com'

    message = MIMEMultipart()
    message['From'] = smtp_username
    message['To'] = to_email
    message['Subject'] = 'Asunto del correo electrónico'

    body = """
    Contenido del correo electrónico.
    Puedes agregar HTML o texto plano aquí.
    """

    message.attach(MIMEText(body, 'plain'))

    with smtplib.SMTP(smtp_server, smtp_port) as server:
        server.starttls()
        server.login(smtp_username, smtp_password)
        server.send_message(message)

# Llama a la función para enviar el correo electrónico
send_email()
