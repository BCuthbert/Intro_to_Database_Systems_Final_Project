#! /usr/bin/python3

from flask import Flask, jsonify
from flask_cors import CORS
from flask import request
import json


app = Flask(__name__)
CORS(app)


@app.route('/')
def homepage():
    print("Hello world")


if __name__ == "__main__":
    app.run(host='0.0.0.0', port=5000)
