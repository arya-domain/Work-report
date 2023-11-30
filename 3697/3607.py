import tkinter as tk
from matplotlib.figure import Figure
from matplotlib.backends.backend_tkagg import FigureCanvasTkAgg
import matplotlib.pyplot as plt
import pandas as pd
import numpy as np
from PIL import Image, ImageTk
import os

os.environ["PATH"] += os.pathsep + "C:/Program Files (x86)/Graphviz/bin"
import fitz
import graphviz
import io
from collections import defaultdict
import tkinter.scrolledtext as st


# Import the data file
import json

dataframe = 0


def filename(filepath):
    global dataframe
    df = []
    with open((f"./{filepath}"), "r") as file:
        for line in file:
            data_dict = json.loads(line)
            df.append(data_dict)
    dataframe = pd.DataFrame(df[0], index=[0])
    for i in range(1, len(df)):
        val = pd.DataFrame(df[i], index=[0])
        dataframe = pd.concat([dataframe, val], ignore_index=True)


def get_visitor_uuid(doc_id):
    global dataframe
    # subject document id
    return dataframe[dataframe["subject_doc_id"] == doc_id]["visitor_uuid"]


def get_document_uuid(visitor_uuid):
    global dataframe
    return dataframe[dataframe["visitor_uuid"] == visitor_uuid]["subject_doc_id"]


root = tk.Tk()
root.title("Data Processing GUI")
frame = tk.Frame(root)
frame.pack()
canvas = None


# task 2
def plot_histogram(visitor_countries, unique_uuid):
    global dataframe
    global canvas
    if canvas is not None:
        canvas.get_tk_widget().pack_forget()
        canvas = None
        plt.cla()

    fig = plt.figure(figsize=(10, 5))
    print(type(visitor_countries))
    colors = plt.cm.viridis(np.linspace(0, 1, unique_uuid))
    visitor_countries.value_counts().plot(kind="bar", color=colors)
    plt.title("Histogram of Visitor Countries")
    plt.xlabel("Country")
    plt.ylabel("Count")

    canvas = FigureCanvasTkAgg(fig, master=frame)
    canvas.draw()
    canvas.get_tk_widget().pack()


def get_visitor_country_for_doc(doc_id=None):
    global dataframe
    if doc_id is None:
        doc_id = str(entry.get())
    doc_df = dataframe[dataframe["subject_doc_id"] == doc_id]

    visitor_countries = doc_df.groupby("visitor_uuid")["visitor_country"]
    plot_histogram(visitor_countries, dataframe["visitor_uuid"].nunique())


# task 3
def view_useragent_histogram():
    global dataframe
    global canvas
    if canvas is not None:
        canvas.get_tk_widget().pack_forget()
        canvas = None
        plt.cla()
    browser = list()
    for i in dataframe["visitor_useragent"]:
        browser.append(i.split("/")[0])
    fig = plt.figure(figsize=(5, 3))
    values, bins, bars = plt.hist(browser)
    plt.xlabel("Visitor Useragent", labelpad=20)
    plt.bar_label(bars, fontsize=8, color="red")
    canvas = FigureCanvasTkAgg(fig, master=frame)
    canvas.draw()
    canvas.get_tk_widget().pack()


# task 4
def read_profiles():
    global dataframe
    global canvas
    if canvas is not None:
        canvas.get_tk_widget().destroy()
        canvas = None
        plt.cla()
    df = (
        dataframe[["visitor_uuid", "event_readtime"]]
        .sort_values(by="event_readtime", ascending=False)
        .head(10)
    )

    fig, ax = plt.subplots(1, 1)
    table_data = []
    for row in df.itertuples():
        table_data.append(row[1:])

    ax.axis("tight")
    ax.axis("off")
    ax.table(cellText=table_data, colLabels=df.columns, cellLoc="center", loc="center")
    canvas = FigureCanvasTkAgg(fig, master=frame)
    canvas.draw()
    canvas.get_tk_widget().pack()


# task 5
def task5(doc_id=None):
    global dataframe
    global canvas
    if canvas is not None:
        canvas.get_tk_widget().destroy()
        canvas = None

    def also_like(doc_uuid=None, visitor_uuid=None, sorting=False):
        global dataframe
        visitor_id = get_visitor_uuid(doc_uuid)
        documents_list = []
        for i in visitor_id:
            document_id = get_document_uuid(i)
            for j in document_id:
                if j is not np.nan:
                    documents_list.append(j)
            if sorting:
                m = list(set(documents_list))
                if len(m) > 10:
                    return list(sorted(m, key=documents_list.count))[:11]
                else:
                    return list(sorted(m, key=documents_list.count))
            else:
                m = []
                for k in documents_list:
                    if k not in m:
                        m.append(k)
                if len(m) > 10:
                    return list(sorted(m, key=documents_list.count))[:11]
                else:
                    return list(sorted(m, key=documents_list.count))

    # document uuid
    if doc_id is None:
        doc_id = str(entry.get())
    val = also_like(doc_uuid=doc_id)
    fig, ax = plt.subplots(1, 1)
    ax.text(
        -0.1, 0.5, f"The most liked documents \n{val}", fontsize=12
    )  # 140228202800-6ef39a241f35301a9a42cd0ed21e5fb0

    ax.axis("off")
    canvas = FigureCanvasTkAgg(fig, master=frame)
    canvas.draw()
    canvas.get_tk_widget().pack()
    return


# task 6
def task6(doc_id=None):
    global dataframe

    def display_pdf_page(pdf_path, page_number):
        global dataframe
        doc = fitz.open(pdf_path)
        pix = doc.load_page(page_number).get_pixmap()
        img = Image.open(io.BytesIO(pix.tobytes()))

        # fig, ax = plt.subplots()
        fig = plt.figure(figsize=(20, 8))  # set figure size
        ax = fig.add_subplot(111)
        ax.imshow(img)
        ax.axis("off")  # to hide the axes

        return fig

    def also_like(doc_uuid=None, visitor_uuid=None, sorting=False):
        global dataframe
        document_id = get_document_uuid(visitor_uuid)
        if sorting:
            df = pd.DataFrame(document_id.value_counts())
            df.rename(columns={"subject_doc_id": "Likes"}, inplace=True)
            id_col = df.index.tolist()
            df.insert(0, "subject_doc_id", id_col, True)
            df = df.reset_index(drop=True)
            return df.sort_values(by="subject_doc_id", ascending=True).head(10)
        else:
            # print(document_id)
            df = pd.DataFrame(document_id.value_counts())
            df.rename(columns={"subject_doc_id": "Likes"}, inplace=True)
            id_col = df.index.tolist()
            df.insert(0, "subject_doc_id", id_col, True)
            df = df.reset_index(drop=True)
            return df.sort_values(by="subject_doc_id", ascending=False).head(10)

    global canvas
    if canvas is not None:
        canvas.get_tk_widget().destroy()
        canvas = None
    dot = graphviz.Digraph(comment="Also likes")
    if doc_id is None:
        doc_id = str(entry.get())
    visitor_uuid = get_visitor_uuid(doc_id)  # give the document id
    d = defaultdict(list)
    node = "A"
    for i in visitor_uuid:
        df = also_like(visitor_uuid=i)["subject_doc_id"].tolist()
        parent_node = node
        dot.node(node, i[-4:])
        if len(df) == 0:
            d[str(node)] = []
            node = chr(ord(node) + 1)
        else:
            node = chr(ord(node) + 1)
            for j in df:
                if j not in d[parent_node] and j is not np.nan:
                    dot.node(str(node), j[-4:])
                    d[parent_node].append(str(node))
                    node = chr(ord(node) + 1)

    connect = list()
    for i in d.keys():
        for j in d[i]:
            connect.append(i + j)
    dot.edges(connect)
    dot.render("also-like.gv")  # store in pdf format
    pdf_path = "./also-like.gv.pdf"
    fig = display_pdf_page(pdf_path, 0)
    canvas = FigureCanvasTkAgg(fig, master=frame)
    canvas.draw()
    canvas.get_tk_widget().pack()


filename("./sample_small.json")


# task-8: command line usage
def execute_command():
    global dataframe

    command = str(cli_entry.get())
    print(command)
    l = command.split(" ")
    task_id = int(l[l.index("-t") + 1])

    if task_id == 2:
        document_uuid = l[l.index("-d") + 1]
        get_visitor_country_for_doc(document_uuid)
    elif task_id == 3:
        view_useragent_histogram()
    elif task_id == 4:
        read_profiles()
    elif task_id == 5:
        document_uuid = l[l.index("-d") + 1]
        task5(document_uuid)
    elif task_id == 6:
        document_uuid = l[l.index("-d") + 1]
        task6(document_uuid)


button_frame = tk.Frame(root)
button_frame.pack(side=tk.TOP, fill=tk.X)


label1 = tk.Label(button_frame, text="Document UUID:")
label1.pack(side=tk.LEFT)
# visitor_uuid input
entry = tk.Entry(button_frame)
entry.pack(side=tk.LEFT)


tk.Button(
    button_frame,
    text="VIEW BY COUNTRY",
    command=get_visitor_country_for_doc,
    height=5,
    width=20,
).pack(padx=(100, 0), side=tk.LEFT)
tk.Button(
    button_frame,
    text="VIEW BY BROWSER",
    command=view_useragent_histogram,
    height=5,
    width=20,
).pack(side=tk.LEFT)
tk.Button(
    button_frame, text="READER PROFILES", command=read_profiles, height=5, width=20
).pack(side=tk.LEFT)
tk.Button(
    button_frame, text="ALSO LIKES FUCTIONALITY", command=task5, height=5, width=20
).pack(side=tk.LEFT)
tk.Button(
    button_frame, text="ALSO LIKES GRAPH", command=task6, height=5, width=20
).pack(side=tk.LEFT)


# Prompt label
prompt_label = tk.Label(root, text=">", fg="white", bg="black")
prompt_label.pack(side=tk.LEFT, padx=(10, 0))

# Create an entry widget for typing commands
cli_entry = tk.Entry(
    root, fg="white", bg="black", insertbackground="white"
)  # Set fg and bg colors
cli_entry.pack(side=tk.LEFT, padx=(0, 10), ipady=50, fill=tk.X, expand=True)
cli_entry.bind("<Return>", lambda event: execute_command())

root.mainloop()
