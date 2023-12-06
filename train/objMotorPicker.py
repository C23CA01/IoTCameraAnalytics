import cv2
import pickle


# WANT!
# mendapatkan 1 blok posisi gambar untuk setiap motor


#(50,190),(140,230)
lebar, tinggi = 90, 40

try:
    with open("Posisi", "rb") as f:
        # menyimpan posisi sebelumnya di posisiMotor
        posisiMotor = pickle.load(f)

except:
    # menyimpan untuk "setiap" posisi kotak
    # jika tdk menemukan yang posisi sebelumnya
    posisiMotor = []

# fungsi kotak akan terbuat ketika ada klik
def pilihKotak(event, x,y,flags, params):
    # nambah kotak jika di klik kiri
    if event == cv2.EVENT_LBUTTONDOWN:
        posisiMotor.append((x,y))
    # ngurangin kotak kalo di klik kanan 
    if event == cv2.EVENT_RBUTTONDOWN:
        for i, pos in enumerate(posisiMotor):
            # tuple as pos() convert to integer
            x1,y1 = pos
            # integer 
            sisi_l = lebar + x1
            sisi_t = tinggi + y1
            if x1  < x < sisi_l and y1 < y < sisi_t:
                posisiMotor.pop(i)

    # membuat(write) file posisi dulu # untuk sementara ketika code berjalan
    with open("Posisi", "wb") as f:
        pickle.dump(posisiMotor,f)
            


# 1 gambar diulang ulang berkali kali framenya 
while True:
    
    # inisiasi target gambar didalam loop 
    img = cv2.imread('framecapt/1.jpg')
    
    for pos in posisiMotor:
        cv2.rectangle(img, pos, (pos[0]+lebar, pos[1]+tinggi), (255,0,255),2 )
    cv2.imshow("image", img)
    
    # ini memanggil fungsi pilih kotak
    # karena pilih kotak berada di dalam loop maka akan di set lagi yang baru kalo user klik mouse kiri
    cv2.setMouseCallback("image", pilihKotak)
    cv2.waitKey(1)
