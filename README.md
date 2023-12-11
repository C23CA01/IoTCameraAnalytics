# IoTCameraAnalytics
Building a web dashboard to monitor the usage of parking area and meeting room using machine learning



Yolov3 Custom dataset final product : 
https://colab.research.google.com/drive/12Q-C6Ga93Od27cnzotWMPncvwXCpu1LO?usp=sharing

proses pelatihan custom dataset model tersebut yang memanfaatkan storage drive : 
https://drive.google.com/drive/folders/1pJFGKdozDHO2j-OryDAubuwhTY9xcGsN?usp=sharing

## finally after training the pre-trained models, Converted to tensorflow(.h5) format and then can see the trainable layers :
![Uji di local](./dokumentasi/ss4.png)

## Step by Step
Please Make sure you've already have dataset whichis the contain is annotated by yolo format using labelimg

1. Set runtime type using python3 and select hardware accelerator T4 GPU
2. Run the following command to activate GPU in google colab
   
```bash
!nvidia-smi
```
3. Utilize existing storage on Google Drive

```bash
from google.colab import drive
drive.mount('/content/drive')
```
4. for the preparation need some configure from Yolov3 darknet official repo:
```bash
!git clone https://github.com/AlexeyAB/darknet.git
```

5. set for configure and compile the repo
```bash
%cd /content/darknet/

!sed -i 's/OPENCV=0/OPENCV=1/' Makefile
!sed -i 's/GPU=0/GPU=1/' Makefile
!sed -i 's/CUDNN=0/CUDNN=1/' Makefile

!make
```
6. Pre-Trained configure layers and adjust the data already annotated
7. copy Yolo Model configuration file to local storage(gdrive)
8. load your dataset
9. download PRE-TRAINED yolo weights
10. Train your customize dataset with pre-tarain models
```bash
%cd ../../
!cd darknet && ./darknet detector /content/darknet/data/obj.data  /content/darknet/cfg/yolov3_training.cfg darknet53.conv.74 -dont_show
```
from that repo I only did the GPU configuration and working environment, and customized the .cfg file to suit the dataset that had been specified

## several failed development attempts
- https://colab.research.google.com/drive/1u6zNZDtFcMFJ6-wIZwHRxpFovz-jo3ab?usp=sharing
- https://colab.research.google.com/drive/1gPinDGV--SQj29wrdRhnrh4wgeJwmIf7?usp=sharing
