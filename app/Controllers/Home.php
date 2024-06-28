<?php

namespace App\Controllers;

use App\Models\Comic;
use Carbon\Carbon;

class Home extends BaseController
{
    protected $comics;

    public function __construct()
    {
        $this->comics = new Comic();
    }

    public function index(): string
    {
        $data = [
            'title' => 'Comic List',
            'comics' => $this->comics->findAll(),
            'keyword' => ''
        ];

        return view('home', $data);
    }

    public function search()
    {
        $keyword = $this->request->getVar('keyword');
        $comics = $this->comics->like('title', $keyword)->findAll();

        $data = [
            'title' => 'Comic List',
            'comics' => $comics,
            'keyword' => $keyword
        ];

        return view('home', $data);
    }

    public function detail($slug): string
    {
        $comic = $this->comics->where('slug', $slug)->first();
        if (!$comic) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Comic with slug $slug not found");
        }

        // Tambahkan updated_at_human ke dalam array $comic
        $comic['updated_at_human'] = \Carbon\Carbon::parse($comic['updated_at'])->diffForHumans();

        $data = [
            'comic' => $comic
        ];

        return view('comic/detail', $data);
    }



    public function add()
    {
        $data = [
            'validation' => \Config\Services::validation()
        ];

        return view('comic/add', $data);
    }

    public function create()
{
    $validation = \Config\Services::validation();

    $rules = [
        'title' => [
            'rules' => 'required|is_unique[comics.title]',
            'errors' => [
                'required' => 'Title harus diisi!',
                'is_unique' => 'Title sudah terdaftar'
            ]
        ],
        'author' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Author harus diisi!'
            ]
        ],
        'genre' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Genre harus diisi!'
            ]
        ],
        'mangaLabel' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Manga Label harus diisi!'
            ]
        ],
        'cover' => [
            'rules' => 'mime_in[cover,image/jpg,image/jpeg,image/png]|max_size[cover,2048]',
            'errors' => [
                'mime_in' => 'File harus berformat jpg/jpeg/png',
                'max_size' => 'Ukuran file maksimal 2MB'
            ]
        ]
    ];

    if (!$this->validate($rules)) {
        return redirect()->to('/comic/add')->withInput()->with('validation', $validation);
    }

    // Ambil file cover
    $fileCover = $this->request->getFile('cover');

    // Jika tidak ada file yang diunggah, gunakan gambar default
    if ($fileCover->getError() == 4) {
        $fileName = 'default.jpg';
    } else {
        // Simpan file gambar yang diunggah dengan nama acak
        $fileName = $fileCover->getRandomName();
        $fileCover->move('img', $fileName);
    }

    $slug = url_title($this->request->getVar('title'), '-', true);

    $this->comics->save([
        'title' => $this->request->getVar('title'),
        'slug' => $slug,
        'author' => $this->request->getVar('author'),
        'mangaLabel' => $this->request->getVar('mangaLabel'),
        'genre' => $this->request->getVar('genre'),
        'cover' => $fileName,
    ]);

    session()->setFlashdata('message', 'Comic successfully added!');

    return redirect()->to('/');
}


    public function delete($slug)
    {
        $comic = $this->comics->where('slug', $slug)->first();
        if (!$comic) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Comic with slug $slug not found");
        }

        $this->comics->delete($comic['id']);
        if ($comic['cover'] != 'default.jpg') {
            unlink('img/' . $comic['cover']);
        }

        session()->setFlashdata('message', 'Comic successfully deleted!');
        return redirect()->to('/');
    }

    public function edit($slug)
    {
        $comic = $this->comics->where('slug', $slug)->first();
        if (!$comic) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Comic with slug $slug not found");
        }

        $data = [
            'validation' => \Config\Services::validation(),
            'comic' => $comic
        ];

        return view('comic/edit', $data);
    }

    public function update($id)
    {
        $oldComic = $this->comics->find($id);
        if (!$oldComic) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Comic with ID $id not found");
        }

        $newTitle = $this->request->getVar('title');
        if ($oldComic['title'] == $newTitle) {
            $rule_title = 'required';
        } else {
            $rule_title = 'required|is_unique[comics.title]';
        }

        $rules = [
            'title' => [
                'rules' => $rule_title,
                'errors' => [
                    'required' => 'Title harus diisi!',
                    'is_unique' => 'Title sudah terdaftar'
                ]
            ],
            'cover' => [
                'rules' => 'mime_in[cover,image/jpg,image/jpeg,image/png]|max_size[cover,2048]',
                'errors' => [
                    'mime_in' => 'File harus berformat jpg/jpeg/png',
                    'max_size' => 'Ukuran file maksimal 2MB'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/comic/edit/' . $oldComic['slug'])->withInput()->with('validation', \Config\Services::validation());
        }

        $slug = url_title($newTitle, '-', true);

        $fileCover = $this->request->getFile('cover');
        if ($fileCover->isValid() && !$fileCover->hasMoved()) {
            $fileName = $fileCover->getRandomName();
            $fileCover->move('img', $fileName);
            if ($oldComic['cover'] != 'default.jpg') {
                unlink('img/' . $oldComic['cover']);
            }
        } else {
            $fileName = $oldComic['cover'];
        }

        $this->comics->save([
            'id' => $id,
            'title' => $newTitle,
            'author' => $this->request->getVar('author'),
            'mangaLabel' => $this->request->getVar('mangaLabel'),
            'slug' => $slug,
            'genre' => $this->request->getVar('genre'),
            'cover' => $fileName,
        ]);

        session()->setFlashdata('message', 'Comic successfully updated!');
        return redirect()->to('/');
    }
}
