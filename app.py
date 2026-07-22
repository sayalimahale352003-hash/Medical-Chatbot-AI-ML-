from quart import Quart, request, jsonify, render_template
from qa_system import initialize_qa_system,handle_simple_queries
import logging
import asyncio

app = Quart(__name__)

# Initialize QA system
qa = initialize_qa_system()

@app.route('/')
async def index():
    return await render_template('index.php')

@app.route('/chat', methods=['POST'])
async def chat():
    user_input = (await request.get_json()).get('input')
    logging.info(f"User input: {user_input}")

    # Check for simple queries
    simple_response = handle_simple_queries(user_input)
    if simple_response:
        logging.info(f"Simple response: {simple_response}")
        return jsonify({"response": simple_response})

    # Otherwise, process with the QA system
    loop = asyncio.get_event_loop()
    result = await loop.run_in_executor(None, qa, {"query": user_input})
    
    logging.info(f"Chatbot response: {result['result']}")
    return jsonify({"response": result["result"]})


if __name__ == '__main__':
    logging.basicConfig(level=logging.INFO)
    from hypercorn.asyncio import serve
    from hypercorn.config import Config

    config = Config()
    config.bind = ["0.0.0.0:5000"]
    asyncio.run(serve(app, config))