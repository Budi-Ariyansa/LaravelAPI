from urllib import response
from tkinter import *
from tkinter import messagebox
from tkinter.font import Font
from ttkbootstrap.constants import *
import ttkbootstrap as ttk
import requests
import threading
import time
import json

global acc_token, usrHeader

class AppAdmin:
    def __init__(self) :
        self.__mainWindow = Tk()
        self.__mainWindow.wm_iconbitmap(r'D:/Study/Belajar Laravel/HTML/View 2/img-ico/ukswlogo-1.ico')
        window_height = 430
        window_width = 300

        sreen_width = self.__mainWindow.winfo_screenwidth()
        screen_height = self.__mainWindow.winfo_screenheight()
        x_cordinate = int((sreen_width/2) - (window_width/2))
        y_cordinate = int((screen_height/2) - (window_height/2))

        self.__mainWindow.geometry("{}x{}+{}+{}".format(window_width, window_height, x_cordinate, y_cordinate-50))
        self.__mainWindow.title("SIAKAD ADMIN")
        self.__mainWindow.resizable(False, False)

        #image
        img = PhotoImage(file=r'D:/Study/Belajar Laravel/HTML/View 2/img-ico/ukswlogo 1.png').subsample(4,4)
        
        #variabel
        nama_lbl = ["Username","Password"]
        self.entries = []

        #font
        self.fontStyleHeading = Font(family="Roboto", size=24, weight="bold")
        self.fontStyle = Font(family="Roboto", size=10)

        #frame
        self.frame_lgn = Frame(self.__mainWindow, padx=30)
        self.frame_lgn.place(relx=0.5, rely=0.5, anchor=CENTER)

        #title
        self.lbl_title = Label(self.frame_lgn, text="LOGIN ADMIN", anchor=CENTER, font=self.fontStyleHeading)
        self.lbl_title.grid(row=0, column=0, columnspan=2, pady=(30, 30))
        self.lbl_img = Label(self.frame_lgn, image=img, anchor=CENTER)
        self.lbl_img.grid(row=1, column=0, columnspan=2, pady=(0,30))

        for x in range(len(nama_lbl)) :
            for y in range(1) :
                lbl = Label(self.frame_lgn, text=nama_lbl[x] + " : ", font=self.fontStyle)
                lbl.grid(row=2+x, column=y, pady=10, sticky=W)
                
                if(x == 1) :
                    ent = ttk.Entry(self.frame_lgn, bootstyle=PRIMARY, show="*")
                    ent.grid(row=2+x, column=y+1, pady=10, sticky=W)
                else :
                    ent = ttk.Entry(self.frame_lgn, bootstyle=PRIMARY)
                    ent.grid(row=2+x, column=y+1, pady=10, sticky=W)
                
                self.entries.append(ent)
        
        #tombol login
        self.btn_login = ttk.Button(self.frame_lgn, text="LOG IN", command=self.login, bootstyle=SUCCESS)
        self.btn_login.grid(row=4, column=0, columnspan=3, sticky="we", pady=(20, 0))
        
        self.__mainWindow.mainloop()

    def mainMenu(self) :
        Tp = Toplevel()
        Tp.wm_iconbitmap(r'D:/Study/Belajar Laravel/HTML/View 2/img-ico/ukswlogo-1.ico')
        Tp.title("Main Menu")
        Tp.configure(bg="#454545")
        Tp.resizable(False, False)

        #membuat frame
        frame_1 = Frame(Tp, pady=20, padx=20)
        frame_1.configure(bg="#454545")
        frame_1.grid(row=0, column=0, padx=20, sticky="n")
        frame_2 = Frame(Tp, pady=20, padx=20, relief=RAISED, borderwidth=5)
        frame_2.grid(row=0, column=1, padx=20, pady=20, sticky="n")
        frame_sub1_1 = Frame(frame_1, padx=20, pady=20, relief=RAISED, borderwidth=5)
        frame_sub1_1.grid(row=0, column=0, sticky=N)
        frame_sub1_2 = Frame(frame_1, padx=20, pady=20, relief=RAISED, borderwidth=5)
        frame_sub1_2.grid(row=1, column=0, sticky=N, pady=(70,40))

        #jam
        self.jam = Label(frame_sub1_2, font=self.fontStyleHeading)
        self.jam.pack()
        self.digitalclock()

        frame_btn_1 = Frame(frame_2)
        frame_btn_1.grid(row=5, column=0, sticky="w")

        self.running = True
        self.usrHeader = ""
        self.hd_tbl = ["User", "Aktivitas", "Waktu", "Status"]

        #heading
        heading = Label(frame_sub1_1, text="Menu Admin", font=self.fontStyleHeading, anchor=CENTER)
        heading.grid(row=0, column=0, columnspan=2, sticky="n", pady=20)

        #menu
        self.menu_1 = ttk.Button(frame_sub1_1, text="TAMBAH DATA MAHASISWA", width=45, command=lambda:self.MenuMahasiswa(2))
        self.menu_1.grid(row=1, column=0, padx=10, pady=5)
        self.menu_2 = ttk.Button(frame_sub1_1, text="CARI / EDIT DATA MAHASISWA", width=45, command=lambda:self.MenuMahasiswa(1))
        self.menu_2.grid(row=2, column=0, padx=10, pady=5)
        self.menu_3 = ttk.Button(frame_sub1_1, text="TAMBAH DATA DOSEN", width=45, command=lambda:self.MenuDosen(2))
        self.menu_3.grid(row=3, column=0, padx=10, pady=5)
        self.menu_4 = ttk.Button(frame_sub1_1, text="CARI / EDIT DATA DOSEN", width=45, command=lambda:self.MenuDosen(1))
        self.menu_4.grid(row=4, column=0, padx=10, pady=5)
        self.menu_5 = ttk.Button(frame_sub1_1, text="MATAKULIAH", width=45)
        self.menu_5.grid(row=5, column=0, padx=10, pady=5)
        self.menu_5 = ttk.Button(frame_sub1_1, text="JADWAL SIAKAD", width=45)
        self.menu_5.grid(row=6, column=0, padx=10, pady=5)
        self.menu_6 = ttk.Button(frame_sub1_1, text="TAGIHAN", width=45)
        self.menu_6.grid(row=7, column=0, padx=10, pady=5)


        #welcome
        self.tw = Label(frame_2, text="Selamat Datang Admin..", font=self.fontStyleHeading)
        self.tw.grid(row=0, column=0, sticky=W)
        self.ti = Label(frame_2, text="Website ini hanya dapat diakses oleh administrator dan jika ada pihak diluar administrator mencoba", font=self.fontStyle).grid(row=1, column=0, sticky=W)
        self.ti2 = Label(frame_2, text="mengakses website ini akan dianggap pelanggaran dan sanksi akan diberlakukan.").grid(row=2, column=0, sticky=W)
        

        #tabel monitoring mahasiswa
        self.t_table = Label(frame_2, text="Monitoring Aktivitas", font="Roboto 13 bold")
        self.t_table.grid(row=3, column=0, sticky="w")

        self.tbl_data = ttk.Treeview(frame_2, bootstyle=INFO, height=25)
        self.tbl_data["columns"] = ("user", "kegiatan", "waktu", "status")

        self.tbl_data.column("#0", width=0, stretch=NO)
        self.tbl_data.column("user", width=150)
        self.tbl_data.column("kegiatan", width=250, stretch=NO)
        self.tbl_data.column("waktu", anchor=CENTER, width=100)
        self.tbl_data.column("status", anchor=CENTER, width=60)

        self.tbl_data.heading("user", text=self.hd_tbl[0], anchor=CENTER)
        self.tbl_data.heading("kegiatan", text=self.hd_tbl[1], anchor=CENTER)
        self.tbl_data.heading("waktu", text=self.hd_tbl[2], anchor=CENTER)
        self.tbl_data.heading("status", text=self.hd_tbl[3], anchor=CENTER)
        self.tbl_data.grid(row=4, column=0, columnspan=2)

        self.btn_run = Button(frame_btn_1, text="Jalankan Monitoring", width=20, pady=5, command=self.startTime)
        self.btn_run.grid(row=0, column=0, pady=10, padx=(0,10), sticky="w")
        self.btn_stop = Button(frame_btn_1, text="Berhenti Monitoring", width=20, pady=5, command=self.stopTime)
        self.btn_stop.grid(row=0, column=1, sticky="w")

        Tp.protocol("WM_DELETE_WINDOW", self.onClosing)
    
    def MenuMahasiswa(self, pilihan) :
        if(pilihan == 1) :
            Tp = Toplevel()
            Tp.wm_iconbitmap(r'D:/Study/Belajar Laravel/HTML/View 2/img-ico/ukswlogo-1.ico')
            Tp.configure(relief=RIDGE, borderwidth=10)
            window_height = 690
            window_width = 470

            sreen_width = Tp.winfo_screenwidth()
            screen_height = Tp.winfo_screenheight()
            x_cordinate = int((sreen_width/2) - (window_width/2))
            y_cordinate = int((screen_height/2) - (window_height/2))

            Tp.geometry("{}x{}+{}+{}".format(window_width, window_height, x_cordinate, y_cordinate))
            Tp.title("CARI / EDIT DATA MAHASISWA")
            Tp.resizable(False, False)

            #labelFrame
            lbl_frame_1 = ttk.LabelFrame(Tp, text="Cari Data Mahasiswa", bootstyle=PRIMARY)
            lbl_frame_1.grid(row=0, column=0, sticky="w", pady=10, padx=20)
            lbl_frame_2 = ttk.LabelFrame(Tp, text="Data Mahasiswa", bootstyle=PRIMARY)
            lbl_frame_2.grid(row=1, column=0, sticky="w", pady=10, padx=20)

            #frame
            btn_frame = Frame(Tp)
            btn_frame.grid(row=2, column=0, padx=10, pady=(10,30), sticky="w")

            #cari mahasiswa
            lbl_input = Label(lbl_frame_1, text="NIM", padx=10, pady=10)
            lbl_input.grid(row=0, column=0, sticky="w")
            self.input_nim = ttk.Entry(lbl_frame_1, width=30, bootstyle=SECONDARY)
            self.input_nim.grid(row=0, column=1, pady=10)
            btn_search = Button(lbl_frame_1, text="Cari", width=5, command=lambda:self.curdSiswa(1))
            btn_search.grid(row=0, column=2, sticky="w", padx=10)

            self.entries.clear()
            nama_lbl = [
                "Nama","NIM","Alamat","TTL",
                "Agama","No Hp","NIK",
                "No KK","Email","Fakultas",
                "Program Studi","Beban SKS",
                ]
            for x in range(len(nama_lbl)) :
                for y in range(1) :
                    lbl = Label(lbl_frame_2, text=nama_lbl[x] + " : ", font=self.fontStyle, padx=10, pady=10)
                    lbl.grid(row=x+1, column=y, sticky=W)
                    
                    ent = ttk.Entry(lbl_frame_2, bootstyle=SECONDARY, width=40)
                    ent.grid(row=x+1, column=y+1, padx=10, sticky=W)

                    self.entries.append(ent)

            btn_simpan = ttk.Button(btn_frame, text="Simpan", bootstyle=SUCCESS, width=15, command=lambda:self.curdSiswa(4))
            btn_simpan.grid(row=0, column=0, sticky="nw", padx=10)
            btn_hapus = ttk.Button(btn_frame, text="Hapus", bootstyle=DANGER, width=15, command=lambda:self.curdSiswa(3))
            btn_hapus.grid(row=0, column=1, sticky="nw")
        elif(pilihan == 2) :
            Tp = Toplevel()
            Tp.wm_iconbitmap(r'D:/Study/Belajar Laravel/HTML/View 2/img-ico/ukswlogo-1.ico')
            Tp.configure(relief=RIDGE, borderwidth=20)
            window_height = 700
            window_width = 440

            sreen_width = Tp.winfo_screenwidth()
            screen_height = Tp.winfo_screenheight()
            x_cordinate = int((sreen_width/2) - (window_width/2))
            y_cordinate = int((screen_height/2) - (window_height/2))

            Tp.geometry("{}x{}+{}+{}".format(window_width, window_height, x_cordinate, y_cordinate))
            Tp.title("TAMBAH DATA MAHASISWA")
            Tp.resizable(False, False)

            #frame
            btn_frame = Frame(Tp)
            btn_frame.grid(row=15, column=0, columnspan=2, pady=10, sticky="w")

            self.entries.clear()
            nama_lbl = [
                "Nama","NIM","Alamat","TTL",
                "Agama","No Hp","NIK",
                "No KK","Email","Fakultas",
                "Program Studi", "Beban SKS",
                "Semester", "Tahun Ajar", "Password"
                ]
            for x in range(len(nama_lbl)) :
                for y in range(1) :
                    lbl = Label(Tp, text=nama_lbl[x] + " : ", font=self.fontStyle, padx=10, pady=10)
                    lbl.grid(row=x, column=y, sticky=W)
                    
                    ent = ttk.Entry(Tp, bootstyle=SECONDARY, width=40)
                    ent.grid(row=x, column=y+1, padx=10, sticky=W)

                    self.entries.append(ent)

            btn_tambah = ttk.Button(btn_frame, text="Tambah", bootstyle=SUCCESS, width=15, command=lambda:self.curdSiswa(2))
            btn_tambah.grid(row=0, column=0, sticky="w", padx=10)
        
    def MenuDosen(self, pilihan) :
        if(pilihan == 1) :
            Tp = Toplevel()
            Tp.wm_iconbitmap(r'D:/Study/Belajar Laravel/HTML/View 2/img-ico/ukswlogo-1.ico')
            Tp.configure(relief=RIDGE, borderwidth=10)
            window_height = 650
            window_width = 470

            sreen_width = Tp.winfo_screenwidth()
            screen_height = Tp.winfo_screenheight()
            x_cordinate = int((sreen_width/2) - (window_width/2))
            y_cordinate = int((screen_height/2) - (window_height/2))

            Tp.geometry("{}x{}+{}+{}".format(window_width, window_height, x_cordinate, y_cordinate))
            Tp.title("CARI / EDIT DATA DOSEN")
            Tp.resizable(False, False)

            #labelFrame
            lbl_frame_1 = ttk.LabelFrame(Tp, text="Cari Data Dosen", bootstyle=PRIMARY)
            lbl_frame_1.grid(row=0, column=0, sticky="w", pady=10, padx=20)
            lbl_frame_2 = ttk.LabelFrame(Tp, text="Data Dosen", bootstyle=PRIMARY)
            lbl_frame_2.grid(row=1, column=0, sticky="w", pady=10, padx=20)

            #frame
            btn_frame = Frame(Tp)
            btn_frame.grid(row=2, column=0, padx=10, pady=(10,30), sticky="w")

            #cari dosen
            lbl_input = Label(lbl_frame_1, text="NID", padx=10, pady=10)
            lbl_input.grid(row=0, column=0, sticky="w")
            self.input_nid = ttk.Entry(lbl_frame_1, width=30, bootstyle=SECONDARY)
            self.input_nid.grid(row=0, column=1, pady=10)
            btn_search = Button(lbl_frame_1, text="Cari", width=5, command=lambda:self.curdDosen(1))
            btn_search.grid(row=0, column=2, sticky="w", padx=10)

            self.entries.clear()
            nama_lbl = [
                "Nama","NID","Alamat","TTL",
                "Agama","No Hp","NIK",
                "No KK","Email","Fakultas","Program Studi"
                ]
            for x in range(len(nama_lbl)) :
                for y in range(1) :
                    lbl = Label(lbl_frame_2, text=nama_lbl[x] + " : ", font=self.fontStyle, padx=10, pady=10)
                    lbl.grid(row=x+1, column=y, sticky=W)
                    
                    ent = ttk.Entry(lbl_frame_2, bootstyle=SECONDARY, width=40)
                    ent.grid(row=x+1, column=y+1, padx=10, sticky=W)

                    self.entries.append(ent)
        
            btn_simpan = ttk.Button(btn_frame, text="Simpan", bootstyle=SUCCESS, width=15, command=lambda:self.curdDosen(4))
            btn_simpan.grid(row=0, column=0, sticky="nw", padx=10)
            btn_hapus = ttk.Button(btn_frame, text="Hapus", bootstyle=DANGER, width=15, command=lambda:self.curdDosen(3))
            btn_hapus.grid(row=0, column=1, sticky="nw")
        elif(pilihan == 2) :
            Tp = Toplevel()
            Tp.wm_iconbitmap(r'D:/Study/Belajar Laravel/HTML/View 2/img-ico/ukswlogo-1.ico')
            Tp.configure(relief=RIDGE, borderwidth=20)
            window_height = 560
            window_width = 430

            sreen_width = Tp.winfo_screenwidth()
            screen_height = Tp.winfo_screenheight()
            x_cordinate = int((sreen_width/2) - (window_width/2))
            y_cordinate = int((screen_height/2) - (window_height/2))

            Tp.geometry("{}x{}+{}+{}".format(window_width, window_height, x_cordinate, y_cordinate))
            Tp.title("TAMBAH DATA DOSEN")
            Tp.resizable(False, False)

            #frame
            btn_frame = Frame(Tp)
            btn_frame.grid(row=13, column=0, columnspan=2, pady=10, sticky="w")

            self.entries.clear()
            nama_lbl = [
                "Nama","NIM","Alamat","TTL",
                "Agama","No Hp","NIK",
                "No KK","Email", "Fakultas",
                "Program Studi", "Password"
                ]
            for x in range(len(nama_lbl)) :
                for y in range(1) :
                    lbl = Label(Tp, text=nama_lbl[x] + " : ", font=self.fontStyle, padx=10, pady=10)
                    lbl.grid(row=x, column=y, sticky=W)
                    
                    ent = ttk.Entry(Tp, bootstyle=SECONDARY, width=40)
                    ent.grid(row=x, column=y+1, padx=10, sticky=W)

                    self.entries.append(ent)

            btn_tambah = ttk.Button(btn_frame, text="Tambah", bootstyle=SUCCESS, width=15, command=lambda:self.curdDosen(2))
            btn_tambah.grid(row=0, column=0, sticky="w", padx=10)
    
    def login(self) :
        inputUser = []
        
        for ent in self.entries :
            inputUser.append(str(ent.get()))

        response = requests.post("http://127.0.0.1:8000/api/login-admin", data={
            'username' : inputUser[0],
            'password' : inputUser[1]
        })
        responseData = response.json()

        if(responseData.get('access_token') != None) :
            global acc_token, usrHeader
            acc_token = responseData['access_token']
            usrHeader = {'Authorization':'Bearer ' + acc_token}
            self.__mainWindow.withdraw()
            self.mainMenu()
        else :
            messagebox.showwarning("Error","Username atau password salah...")

    def runTime(self) :
        while(self.running) :
            i = 0
            if(usrHeader != "") :
                response = requests.get("http://127.0.0.1:8000/api/ambil-riwayat", headers=usrHeader)
                responseData = response.json()
                while(i < len(responseData)) :
                    self.tbl_data.insert(parent="", index="end", iid=i, text="", value=(responseData[i]['user'], responseData[i]['kegiatan'], responseData[i]['waktu'],responseData[i]['status']))
                    i += 1
                time.sleep(5)
                self.tbl_data.delete(*self.tbl_data.get_children())
    
    def startTime(self) :
        self.running = True
        startD = threading.Thread(target=self.runTime)
        startD.setDaemon(True)
        startD.start()
        
    def stopTime(self) :
        self.tbl_data.delete(*self.tbl_data.get_children())
        self.running = False

    def curdSiswa(self, pilihan) :
        if(pilihan == 1) :
            i=0
            nim = {"nim": self.input_nim.get()}
            response = requests.post("http://127.0.0.1:8000/api/cari-siswa", data=nim, headers=usrHeader)
            data =  response.json()
            nama_ent = [
                "nama_siswa","nim","alamat","ttl_siswa",
                "agama","no_hp","nik",
                "no_kk","email","fakultas",
                "program_studi","beban_sks",
                ]
            for ent in self.entries :
                if(i == 9) :
                    ent.delete(0, END)
                    ent.insert(0, data['fakultas']['nama_fakultas'])
                elif (i == 10) :
                    ent.delete(0, END)
                    ent.insert(0, data['fakultas']['program_studi'])
                else :
                    ent.delete(0, END)
                    ent.insert(0, data[nama_ent[i]])
                
                i += 1
        elif (pilihan == 2) :
            dataBaru = []
            for ent in self.entries :
                dataBaru.append(str(ent.get()))

            response = requests.post("http://127.0.0.1:8000/api/tambah-siswa", data={
                'nama_siswa': dataBaru[0],'nim': dataBaru[1],
                'alamat': dataBaru[2],'ttl_siswa': dataBaru[3],
                'agama': dataBaru[4],'no_hp': dataBaru[5],
                'nik': dataBaru[6],'no_kk': dataBaru[7],            
                'email': dataBaru[8],'fakultas' : dataBaru[9],
                'program_studi': dataBaru[10], 'beban_sks': dataBaru[11],
                'semester': dataBaru[12], 'tahun_ajar': dataBaru[13],
                'password': dataBaru[14],
            }, headers=usrHeader)

            data =  response.json()
            if(data.get("message")) :
                for ent in self.entries :
                    ent.delete(0, END)
            else :            
                ds = json.dumps(response.json(), indent=1)
                messagebox.showerror("Error", "{}".format(ds))
        elif (pilihan == 3) :
            nim = {"nim": self.input_nim.get()}
            response = requests.post("http://127.0.0.1:8000/api/hapus-siswa", data=nim, headers=usrHeader)

        elif (pilihan == 4) :
            dataBaru = []
            for ent in self.entries :
                dataBaru.append(str(ent.get())) 
            response = requests.post("http://127.0.0.1:8000/api/update-siswa", data={
               'nama_siswa': dataBaru[0],'nim': dataBaru[1],
                'alamat': dataBaru[2],'ttl_siswa': dataBaru[3],
                'agama': dataBaru[4],'no_hp': dataBaru[5],
                'nik': dataBaru[6],'no_kk': dataBaru[7],            
                'email': dataBaru[8],'fakultas' : dataBaru[9],
                'program_studi': dataBaru[10],
            }, headers=usrHeader)
            data = response.json()

    def curdDosen(self, pilihan) :
        if(pilihan == 1) :
            i=0
            nid = {"nid": self.input_nid.get()}
            response = requests.post("http://127.0.0.1:8000/api/cari-dosen", data=nid, headers=usrHeader)
            data =  response.json()
            nama_ent = [
                "nama_dosen","nid","alamat","ttl_dosen",
                "agama","no_hp","nik",
                "no_kk","email","fakultas","program_studi"
                ]
            for ent in self.entries :
                if(i == 9) :
                    ent.delete(0, END)
                    ent.insert(0, data['fakultas']['nama_fakultas'])
                elif (i == 10) :
                    ent.delete(0, END)
                    ent.insert(0, data['fakultas']['program_studi'])
                else :
                    ent.delete(0, END)
                    ent.insert(0, data[nama_ent[i]])
                i += 1
        elif (pilihan == 2) :
            dataBaru = []
            for ent in self.entries :
                dataBaru.append(str(ent.get()))

            response = requests.post("http://127.0.0.1:8000/api/tambah-dosen", data={
                'nama_siswa': dataBaru[0],'nim': dataBaru[1],
                'alamat': dataBaru[2],'ttl_siswa': dataBaru[3],
                'agama': dataBaru[4],'no_hp': dataBaru[5],
                'nik': dataBaru[6],'no_kk': dataBaru[7],
                'email': dataBaru[8],'fakultas' : dataBaru[9], 'program_studi': dataBaru[10],
                'password': dataBaru[11],
            }, headers=usrHeader)
            data =  response.json()
            if(data.get("message")) :
                for ent in self.entries :
                    ent.delete(0, END)
            else :            
                ds = json.dumps(response.json(), indent=1)
                messagebox.showerror("Error", "{}".format(ds))
        elif (pilihan == 3) :
            nid = {"nid": self.input_nid.get()}
            response = requests.post("http://127.0.0.1:8000/api/hapus-dosen", data=nid, headers=usrHeader)
            msg = response.json()
            if(msg.get("message")) :
                for ent in self.entries :
                    ent.delete(0, END)
        elif (pilihan == 4) :
            i=0
            dataBaru = []
            for ent in self.entries :
                dataBaru.append(str(ent.get()))

            response = requests.post("http://127.0.0.1:8000/api/update-dosen", data={
                'nama_siswa': dataBaru[0],'nim': dataBaru[1],
                'alamat': dataBaru[2],'ttl_siswa': dataBaru[3],
                'agama': dataBaru[4],'no_hp': dataBaru[5],
                'nik': dataBaru[6],'no_kk': dataBaru[7],
                'email': dataBaru[8],'fakultas' : dataBaru[9],
                'password': dataBaru[10],
            }, headers=usrHeader)
            data =  response.json()
            if(data.get("message")) :
                for ent in self.entries :
                    ent.delete(0, END)
                    ent.insert(0, data[nama_ent[i]])
                    i += 1
            else :            
                ds = json.dumps(response.json(), indent=1)
                messagebox.showerror("Error", "{}".format(ds))

    def digitalclock(self):
        text_input = time.strftime("%H:%M:%S")
        self.jam.config(text=text_input)
        self.jam.after(200, self.digitalclock)

    def onClosing(self) :
        if (messagebox.askokcancel("Quit", "Do you want to quit?")):
            self.__mainWindow.destroy()

run = AppAdmin()
