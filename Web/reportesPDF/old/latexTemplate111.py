## -*- coding: UTF8 -*-
import os
import codecs

directory = "./"
extension = ".csv"
files = [file for file in os.listdir(directory) if file.lower().endswith(extension)]

t = open(directory+"tipo.txt","r")
tipo = t.read()
t.close()

for file in files:
   csv = file[0]+".csv"
   tit = directory+"titulo"+file[0]+".txt"
   f = open(tit, "r")
   nombre = f.read()
   f.close()

   print r"\pagebreak"
   if(file[0] == '1'):
      print r"\section{Resultados}"
   print r"\subsection{%s}" % nombre

   if(tipo[0] == '0'):
      inf = directory+"info"+file[0]+".txt"
      i = open(inf, 'r')
      cadMedia = 'infoMedia'+file[0]+'.txt'
      cadMax = 'infoMax'+file[0]+'.txt'
      cadMin = 'infoMin'+file[0]+'.txt'
      cadPrec = 'infoPrec'+file[0]+'.txt'

      print r"Clima al presente\\"
      print r"\begin{table}[H]"
      print r"\begin{tabular}{crc}"
      print r"\multirow{3}{*}{\includegraphics[height=1.15cm]{./logos/icon-thermometer.png}} & media &  \input{%s} $^{\circ}$C\\" %cadMedia
      print r"                & maxima & \input{%s} $^{\circ}$C \\" %cadMax
      print r"                & minima & \input{%s} $^{\circ}$C \\" %cadMin
      print r"\includegraphics[height=0.8cm]{./logos/icon-drop.png}&   \input{%s} mm     & " %cadPrec
      print r"\end{tabular}"
      print r"\end{table}"

      nombreTabla = directory+"infoTabla"+file[0]+".txt"
      infoTabla = open(nombreTabla, "r")
      rl = infoTabla.readline()[:-1]

      print r"\begin{table}[H]"
      print r"\caption{Cambios proyectados respecto al promedio hist\'orico: intervalo de variaci\'on entre los cuatro modelos de circulaci\'on global}"
      print r"\begin{tabular}{cccc}"
      print r"&Periodo& RCP 4.5 & RCP 8.5 \\"
      print r"\multirow{6}{*}{\textcolor{brown}{Temperatura m\'inima ($^{\circ}$C)}} & \multirow{2}{*}{2015-2039} & \multirow{2}{*}{"
      print r"%s" %rl
      rl = infoTabla.readline()[:-1]
      print r" y %s" %rl
      rl = infoTabla.readline()[:-1]
      print r"}  & \multirow{2}{*}{%s" %rl
      rl = infoTabla.readline()[:-1]
      print r" y %s}   \\" %rl
      print r" & & & \\"
      rl = infoTabla.readline()[:-1]
      print r"                                    & \multirow{2}{*}{2045-2069} & \multirow{2}{*}{%s" %rl
      rl = infoTabla.readline()[:-1]
      print r" y %s}  & \multirow{2}{*}{" %rl
      rl = infoTabla.readline()[:-1]
      print r"%s y " %rl
      rl = infoTabla.readline()[:-1]
      print r"%s}   \\" %rl
      print r" & & & \\"
      rl = infoTabla.readline()[:-1]
      print r"                                    & \multirow{2}{*}{2075-2099} & \multirow{2}{*}{%s" %rl
      rl = infoTabla.readline()[:-1]
      print r" y %s}" %rl
      rl = infoTabla.readline()[:-1]
      print r" & \multirow{2}{*}{%s" %rl
      rl = infoTabla.readline()[:-1]
      print r" y %s} \\" %rl
      print r" & & & \\"
      rl = infoTabla.readline()[:-1]
      print r"\multirow{6}{*}{\textcolor{orange}{Temperatura media ($^{\circ}$C)}} & \multirow{2}{*}{2015-2039} & \multirow{2}{*}{%s" %rl
      rl = infoTabla.readline()[:-1]
      print r" y %s" %rl
      rl = infoTabla.readline()[:-1]
      print r"}  & \multirow{2}{*}{%s" %rl
      rl = infoTabla.readline()[:-1]
      print r" y %s}   \\" %rl
      print r" & & & \\"
      rl = infoTabla.readline()[:-1]
      print r"                                    & \multirow{2}{*}{2045-2069} & \multirow{2}{*}{%s" %rl
      rl = infoTabla.readline()[:-1]
      print r" y %s}  & \multirow{2}{*}{" %rl
      rl = infoTabla.readline()[:-1]
      print r"%s y " %rl
      rl = infoTabla.readline()[:-1]
      print r"%s}   \\" %rl
      print r" & & & \\"
      rl = infoTabla.readline()[:-1]
      print r"                                    & \multirow{2}{*}{2075-2099} & \multirow{2}{*}{%s" %rl
      rl = infoTabla.readline()[:-1]
      print r" y %s}" %rl
      rl = infoTabla.readline()[:-1]
      print r" & \multirow{2}{*}{%s" %rl
      rl = infoTabla.readline()[:-1]
      print r" y %s} \\" %rl
      print r" & & & \\"
      rl = infoTabla.readline()[:-1]
      print r"\multirow{6}{*}{\textcolor{red2}{Temperatura m\'axima ($^{\circ}$C)}} & \multirow{2}{*}{2015-2039} & \multirow{2}{*}{%s" %rl
      rl = infoTabla.readline()[:-1]
      print r" y %s" %rl
      rl = infoTabla.readline()[:-1]
      print r"}  & \multirow{2}{*}{%s" %rl
      rl = infoTabla.readline()[:-1]
      print r" y %s}   \\" %rl
      rl = infoTabla.readline()[:-1]
      print r" & & & \\"
      # rl = infoTabla.readline()[:-1]
      print r"                                    & \multirow{2}{*}{2045-2069} & \multirow{2}{*}{%s" %rl
      rl = infoTabla.readline()[:-1]
      print r" y %s}  & \multirow{2}{*}{" %rl
      rl = infoTabla.readline()[:-1]
      print r"%s y " %rl
      rl = infoTabla.readline()[:-1]
      print r"%s}   \\" %rl
      print r" & & & \\"
      rl = infoTabla.readline()[:-1]
      print r"                                    & \multirow{2}{*}{2075-2099} & \multirow{2}{*}{%s" %rl
      rl = infoTabla.readline()[:-1]
      print r" y %s}" %rl
      rl = infoTabla.readline()[:-1]
      print r" & \multirow{2}{*}{%s" %rl
      rl = infoTabla.readline()[:-1]
      print r" y %s} \\" %rl
      print r" & & & \\"
      rl = infoTabla.readline()[:-1]
      print r"\multirow{6}{*}{\textcolor{blue}{Precipitaci\'on total (mm) }\textcolor{grey}{(o/o)}} & \multirow{2}{*}{2015-2039} & %s" %rl
      rl = infoTabla.readline()[:-1]
      print r" y %s" %rl
      rl = infoTabla.readline()[:-1]
      print r"   & %s" %rl
      rl = infoTabla.readline()[:-1]
      print r" y %s   \\" %rl
      rl = infoTabla.readline()[:-1]
      print r"                                    &                            & \textcolor{grey}{%s}" %rl
      rl = infoTabla.readline()[:-1]
      print r" y \textcolor{grey}{%s}" %rl
      rl = infoTabla.readline()[:-1]
      print r"   & \textcolor{grey}{%s}" %rl
      rl = infoTabla.readline()[:-1]
      print r" y \textcolor{grey}{%s}   \\" %rl
      rl = infoTabla.readline()[:-1]
      print r"                                    & \multirow{2}{*}{2045-2069} & %s" %rl
      rl = infoTabla.readline()[:-1]
      print r" y %s  & " %rl
      rl = infoTabla.readline()[:-1]
      print r"%s y " %rl
      rl = infoTabla.readline()[:-1]
      print r"%s \\" %rl
      rl = infoTabla.readline()[:-1]
      print r"                                    &                            & \textcolor{grey}{%s}" %rl
      print r" y "
      rl = infoTabla.readline()[:-1]
      print r"\textcolor{grey}{%s} & " %rl
      rl = infoTabla.readline()[:-1]
      print r"\textcolor{grey}{%s} y " %rl
      rl = infoTabla.readline()[:-1]
      print r"\textcolor{grey}{%s} \\" %rl
      rl = infoTabla.readline()[:-1]
      print r"                                    & \multirow{2}{*}{2075-2099} & %s" %rl
      rl = infoTabla.readline()[:-1]
      print r" y %s & " %rl
      rl = infoTabla.readline()[:-1]
      print r"%s y " %rl
      rl = infoTabla.readline()[:-1]
      print r"%s \\" %rl
      rl = infoTabla.readline()[:-1]
      print r"                                    &                            & \textcolor{grey}{%s}" %rl
      rl = infoTabla.readline()[:-1]
      print r" y \textcolor{grey}{%s} & " %rl
      rl = infoTabla.readline()[:-1]
      print r"\textcolor{grey}{%s} y " %rl
      rl = infoTabla.readline()[:-1]
      print r"\textcolor{grey}{%s}" %rl
      print r"\end{tabular}"
      print r"\end{table}"
      infoTabla.close()


      nombreYears = directory+"years"+file[0]+".txt"
      years = open(nombreYears, "r")
      rl = years.readline()[:-1]

      print r"\begin{table}[H]"
      print r"\caption{Temperaturas m\'inimas anuales para los periodos histo\'oricos y los cuatro modelos de circulaci\'on global}"
      print r"\begin{tabular}{lcccccc}"
      print r"\cline{2-7}"
      print r"&\multicolumn{6}{c}{\textbf{Modelos}} \\ \hline"
      print r"& Historico & CNRMCM5 & MPI\_ESM\_LR &  HADGEM2\_ES & GFDL\_CM3 & Promedio* \\ \hline"

      print r"1950-1979 & %s & - & - & - & - & -\\" %rl
      rl = years.readline()[:-1]
      print r"1980-2009 & %s & -  & -  & -  & -  & -\\" %rl

      rl = years.readline()[:-1]
      print r"2015-2039 (RCP 4.5) & -  & %s " %rl
      rl = years.readline()[:-1]
      print r"& %s " %rl
      rl = years.readline()[:-1]
      print r"& %s " %rl
      rl = years.readline()[:-1]
      print r"& %s " %rl
      rl = years.readline()[:-1]
      print r"& %s \\" %rl

      rl = years.readline()[:-1]
      print r"2015-2039 (RCP 8.5) & -  & %s " %rl
      rl = years.readline()[:-1]
      print r"& %s " %rl
      rl = years.readline()[:-1]
      print r"& %s " %rl
      rl = years.readline()[:-1]
      print r"& %s " %rl
      rl = years.readline()[:-1]
      print r"& %s \\" %rl

      rl = years.readline()[:-1]
      print r"2045-2069 (RCP 4.5) & -  & %s " %rl
      rl = years.readline()[:-1]
      print r"& %s " %rl
      rl = years.readline()[:-1]
      print r"& %s " %rl
      rl = years.readline()[:-1]
      print r"& %s " %rl
      rl = years.readline()[:-1]
      print r"& %s \\" %rl

      rl = years.readline()[:-1]
      print r"2045-2069 (RCP 8.5) & -  & %s " %rl
      rl = years.readline()[:-1]
      print r"& %s " %rl
      rl = years.readline()[:-1]
      print r"& %s " %rl
      rl = years.readline()[:-1]
      print r"& %s " %rl
      rl = years.readline()[:-1]
      print r"& %s \\" %rl

      rl = years.readline()[:-1]
      print r"2075-2099 (RCP 4.5) & -  & %s " %rl
      rl = years.readline()[:-1]
      print r"& %s " %rl
      rl = years.readline()[:-1]
      print r"& %s " %rl
      rl = years.readline()[:-1]
      print r"& %s " %rl
      rl = years.readline()[:-1]
      print r"& %s \\" %rl

      rl = years.readline()[:-1]
      print r"2075-2099 (RCP 8.5) & -  & %s " %rl
      rl = years.readline()[:-1]
      print r"& %s " %rl
      rl = years.readline()[:-1]
      print r"& %s " %rl
      rl = years.readline()[:-1]
      print r"& %s " %rl
      rl = years.readline()[:-1]
      print r"& %s \\ \hline" %rl

      print r"& \multicolumn{1}{l}{} & \multicolumn{1}{l}{} & \multicolumn{1}{l}{} & \multicolumn{1}{l}{} & \multicolumn{1}{l}{} & \multicolumn{1}{l}{}"
      print r"\end{tabular}"
      print r"\end{table}"






      # print r"\bf{Cambio proyectado (RCP 8.5)\\}"

      var = i.readline()
      if(float(var[:4]) >= 0):
         cad = "exceder\\'a"
      else:
         cad = "disminuir\\'a"
      # print r"La \textcolor{red}{temperatura m\'axima} en el ANP %s el promedio historico por:\\" % cad

      # print r"\begin{itemize}"
      # print r"\setlength\itemsep{1em}"
      # print r"\item[*] %s  $^\circ$C para el periodo 2015-2039\\" % var
      var = i.readline()
      # print r"\item[*] %s  $^\circ$C para el periodo 2075-2099\\" % var
      # print r"\end{itemize}"

      var = i.readline()
      if(float(var[:4]) >= 0):
         cad = "exceder\\'a"
      else:
         cad = "disminuir\\'x"
      # print r"La \textcolor{yellow}{temperatura m\'inima} en el ANP %s el promedio historico por:\\" % cad
      # print r"\begin{itemize}"
      # print r"\setlength\itemsep{0em}"
      # print r"\item[*] %s  $^\circ$C para el periodo 2015-2039\\" % var
      var = i.readline()
      # print r"\item[*] %s  $^\circ$C para el periodo 2075-2099\\" % var
      # print r"\end{itemize}"

      var = i.readline()
      if(float(var[:4]) >= 0):
         cad = "exceder\\'a"
      else:
         cad = "disminuir\\'a"
      # print r"La \textcolor{blue}{precipitaci\'on promedio} en el ANP %s el promedio historico por:\\" % cad
      # print r"\begin{itemize}"
      # print r"\item[*] %s  $^\circ$C para el periodo 2015-2039\\" % var
      var = i.readline()
      # print r"\item[*] %s  $^\circ$C para el periodo 2075-2099\\" % var
      # print r"\end{itemize}"
      i.close()
   else:
      print r""


   nombreCaption = directory+"caption"+file[0]+".txt"
   caption = open(nombreCaption, "r")
   variable = caption.readline()[:-1]
   periodo = caption.readline()[:-1]
   caption.close()

   print r"\begin{figure}[H]"
   print r"\centering"
   print r"\includegraphics[trim= 0 0 0 80, clip, width=10cm,height=10cm]{%s}" % (directory+file[0]+'N')
   print r"\caption{Cambios proyectados por los cuatro modelos de circulaci\'on global para la  %s" %variable
   print r" en el periodo %s}" %periodo
   print r"\end{figure}"

   nombreCaption2 = directory+"caption2"+file[0]+".txt"
   caption2 = open(nombreCaption2, "r")
   variable2 = caption2.readline()[:-1]
   periodo2 = caption2.readline()[:-1]
   modelo2 = caption2.readline()[:-1]
   forz2 = caption2.readline()[:-1]
   caption2.close()

   # print "modelo: ", modelo2
   # print "forza: ", forz2

   print r"\begin{figure}[H]"
   print r"\centering"
   print r"\includegraphics[trim= 0 0 0 80, clip, width=10cm,height=10cm]{%s}" % (directory+file[0])
   print r"\caption{Dispersi\'on de la %s" % variable2
   print r" para el periodo %s" %periodo2
   print r" con el modelo %s" %modelo2
   print r" y RCP %s}" %forz2
   print r"\end{figure}"

   nombreStatics = directory+"statics"+file[0]+".txt"
   statics = open(nombreStatics, "r")

   print r"\begin{center}"
   print r"\begin{table}[H]"
   print r"\caption{Mediana, cuartil Q1, cuartil Q3 y valores m\'inimo y m\'aximo para la %s " %variable2
   print r"en el periodo %s " %periodo2
   print r"para el modelo %s " %modelo2
   print r"con forzamiento %s}" %forz2
   print r"\begin{tabular}{cccccc}"
   print r"\hline"
   print r"          & Mediana & Q1  & Q3  & Valor m\'inimo & Valor m\'aximo \\ \hline"
   rl = statics.readline()[:-1]
   print r"1950-1979 & %s     &" %rl
   rl = statics.readline()[:-1]
   print r" %s & " %rl
   rl = statics.readline()[:-1]
   print r" %s & " %rl
   rl = statics.readline()[:-1]
   print r" %s & " %rl
   rl = statics.readline()[:-1]
   print r" %s          \\" %rl
   rl = statics.readline()[:-1]
   print r"1980-2009 & %s     &" %rl
   rl = statics.readline()[:-1]
   print r" %s & " %rl
   rl = statics.readline()[:-1]
   print r" %s & " %rl
   rl = statics.readline()[:-1]
   print r" %s & " %rl
   rl = statics.readline()[:-1]
   print r" %s          \\" %rl
   rl = statics.readline()[:-1]
   print r"2015-2039 & %s     &" %rl
   rl = statics.readline()[:-1]
   print r" %s & " %rl
   rl = statics.readline()[:-1]
   print r" %s & " %rl
   rl = statics.readline()[:-1]
   print r" %s & " %rl
   rl = statics.readline()[:-1]
   print r" %s          \\" %rl
   rl = statics.readline()[:-1]
   print r"2045-2069 & %s     &" %rl
   rl = statics.readline()[:-1]
   print r" %s & " %rl
   rl = statics.readline()[:-1]
   print r" %s & " %rl
   rl = statics.readline()[:-1]
   print r" %s & " %rl
   rl = statics.readline()[:-1]
   print r" %s          \\" %rl
   rl = statics.readline()[:-1]
   print r"2075-2099 & %s     &" %rl
   rl = statics.readline()[:-1]
   print r" %s & " %rl
   rl = statics.readline()[:-1]
   print r" %s & " %rl
   rl = statics.readline()[:-1]
   print r" %s & " %rl
   rl = statics.readline()[:-1]
   print r" %s          \\ \hline" %rl
   print r"\end{tabular}"
   print r"\end{table}"
   print r"\end{center}"
   statics.close()
   print r"\newpage"





   # print r"\begin{center}"
   # print r"\csvautobooktabular{%s}" % file
   # print r"\end{center}"

