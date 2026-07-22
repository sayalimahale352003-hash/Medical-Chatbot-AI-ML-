from langchain.vectorstores import FAISS
from langchain.embeddings import HuggingFaceEmbeddings
from langchain import PromptTemplate
from langchain.chains import RetrievalQA
from langchain.llms import CTransformers
import torch
from functools import lru_cache

def initialize_qa_system(db_faiss_path="vectorstores/db_faiss"):
    prompt_template = """
    Use the following pieces of information to answer the user's question.
    If you don't know the answer, just say that you don't know, don't try to make up an answer.

    Context: {context}
    Question: {question}

    Only return the helpful answer below and nothing else.
    Helpful answer:
    """

    PROMPT = PromptTemplate(template=prompt_template, input_variables=["context", "question"])

    chain_type_kwargs = {"prompt": PROMPT}

    device = "cuda" if torch.cuda.is_available() else "cpu"

    llm = CTransformers(model="llama-2-7b-chat.ggmlv3.q4_0 (1).bin", model_type="llama", config={'max_new_tokens': 512, 'temperature': 0.8}, device=device)

    embeddings = HuggingFaceEmbeddings(model_name='sentence-transformers/all-MiniLM-L6-v2', model_kwargs={'device': device})
    db = FAISS.load_local(db_faiss_path, embeddings)

    qa = RetrievalQA.from_chain_type(llm=llm, chain_type="stuff", retriever=db.as_retriever(search_kwargs={'k': 2}), return_source_documents=True, chain_type_kwargs=chain_type_kwargs)
    return qa


def handle_simple_queries(query):
    simple_responses = {
        "hello": "Hello! How can I assist you today?",
        "hi": "Hi there! How can I help you?",
        "thank you": "You're welcome! If you have any other questions, feel free to ask.",
        "thanks": "You're welcome! Let me know if there's anything else I can help with."
    }
    return simple_responses.get(query.lower(), None)