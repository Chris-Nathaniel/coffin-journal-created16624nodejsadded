import requests
import base64

API_BASE_URL = "https://api.sws.speechify.com"
API_KEY = 'FVo956RVtf8aWCCVQVaDCZRonfplHmgWe5AaBJdjzv8='
VOICE_ID = "george"

def get_audio(text):
    url = f"{API_BASE_URL}/v1/audio/speech"
    headers = {
        "Authorization": f"Bearer {API_KEY}",
        "Content-Type": "application/json"
    }
    body = {
        "input": f"<speak>{text}</speak>",
        "voice_id": VOICE_ID,
        "audio_format": "mp3"
    }

    response = requests.post(url, json=body, headers=headers)

    if response.status_code != 200:
        raise Exception(f"{response.status_code} {response.reason}\n{response.text}")

    response_data = response.json()
    decoded_audio_data = base64.b64decode(response_data["audio_data"])

    return decoded_audio_data

def main():
    audio = get_audio("Hello, world!")
    with open("./speech.mp3", "wb") as audio_file:
        audio_file.write(audio)

if __name__ == "__main__":
    main()
