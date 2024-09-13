<?php

namespace App\Livewire;

use Livewire\Component;

class About extends Component
{
    public $misyonumuz;
    public $vizyonumuz;
    public $ekibimiz;

    public function mount()
    {
        $this->misyonumuz = "Her evcil hayvana sevgi dolu bir yuva bulmak, sahiplenme sürecini kolaylaştırmak ve toplumda hayvan sevgisini artırmak.";
        $this->vizyonumuz = "Türkiye'de evcil hayvan sahiplenme kültürünü geliştirmek, sokak hayvanı sayısını azaltmak ve hayvan haklarını güçlendirmek.";
        $this->ekibimiz = [
            [
                'isim' => 'Ayşe Yılmaz',
                'pozisyon' => 'Kurucu',
                'aciklama' => 'Hayvan hakları aktivisti ve veteriner hekim'
            ],
            [
                'isim' => 'Mehmet Kaya',
                'pozisyon' => 'Operasyon Müdürü',
                'aciklama' => 'Deneyimli barınak yöneticisi'
            ],
            [
                'isim' => 'Zeynep Demir',
                'pozisyon' => 'İletişim Sorumlusu',
                'aciklama' => 'Sosyal medya uzmanı ve gönüllü koordinatörü'
            ]
        ];
    }

    public function render()
    {
        return view('livewire.about', [
            'misyonumuz' => $this->misyonumuz,
            'vizyonumuz' => $this->vizyonumuz,
            'ekibimiz' => $this->ekibimiz
        ]);
    }
}
