import logging
from langchain.document_loaders import PyPDFLoader, DirectoryLoader
from langchain.text_splitter import RecursiveCharacterTextSplitter
from langchain.embeddings import HuggingFaceEmbeddings
from langchain.vectorstores import FAISS

# Configure logging
logging.basicConfig(level=logging.INFO)
logger = logging.getLogger(__name__)

def load_pdf(data_path="data/", db_faiss_path="vectorstores/db_faiss"):
    logger.info("Loading PDFs from directory: %s", data_path)
    loader = DirectoryLoader(data_path, glob="*.pdf", loader_cls=PyPDFLoader)
    documents = loader.load()

    text_splitter = RecursiveCharacterTextSplitter(chunk_size=500, chunk_overlap=20)
    texts = text_splitter.split_documents(documents)

    logger.info("Loaded %d documents, split into %d texts", len(documents), len(texts))

    embeddings = HuggingFaceEmbeddings(model_name='sentence-transformers/all-MiniLM-L6-v2', model_kwargs={'device': 'cpu'})

    db = FAISS.from_documents(texts, embeddings)
    db.save_local(db_faiss_path)
    logger.info("FAISS index saved to %s", db_faiss_path)

if __name__ == "__main__":
    load_pdf()