<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\User;
    class UserController extends Controller
    {
        //
        protected $users = [
            [
                "id" => 1,
                "author" => "Ethan Gray",
                "blog_title" => "5G Technology: Revolutionizing Connectivity",
                "blog_content" => "How 5G is setting new standards in mobile communication and internet speeds.",
                "date_published" => "2024-02-01"
            ],
            [
                "id" => 2,
                "author" => "Ava Patel",
                "blog_title" => "The Evolution of User Experience (UX) Design",
                "blog_content" => "A look into how UX design has evolved and where it’s heading in 2024.",
                "date_published" => "2024-02-03"
            ],
            [
                "id" => 3,
                "author" => "Daniel Nguyen",
                "blog_title" => "The Role of Machine Learning in Healthcare",
                "blog_content" => "How machine learning algorithms are revolutionizing diagnostics and patient care.",
                "date_published" => "2024-02-05"
            ],
            [
                "id" => 4,
                "author" => "Isabella Wright",
                "blog_title" => "Managing Global Teams Across Time Zones",
                "blog_content" => "Strategies for effectively leading and collaborating with teams spread across the world.",
                "date_published" => "2024-02-07"
            ],
            [
                "id" => 5,
                "author" => "Michael Rivera",
                "blog_title" => "Content Marketing in the Age of AI",
                "blog_content" => "How AI-driven tools are reshaping the way content is created and distributed.",
                "date_published" => "2024-02-09"
            ],
            [
                "id" => 6,
                "author" => "Ella James",
                "blog_title" => "Cryptocurrency: Understanding the Risks and Rewards",
                "blog_content" => "A comprehensive guide to navigating the volatile world of cryptocurrency.",
                "date_published" => "2024-02-11"
            ],
            [
                "id" => 7,
                "author" => "Lucas Green",
                "blog_title" => "The Future of Augmented Reality in Retail",
                "blog_content" => "Exploring how AR is transforming the customer experience and the future of retail shopping.",
                "date_published" => "2024-02-13"
            ],
            [
                "id" => 8,
                "author" => "Mila Thompson",
                "blog_title" => "AI in Creative Industries: Friend or Foe?",
                "blog_content" => "Debating the impact of AI on creative jobs like writing, design, and art.",
                "date_published" => "2024-02-15"
            ],
            [
                "id" => 9,
                "author" => "Henry Lewis",
                "blog_title" => "Cybersecurity Best Practices for Small Businesses",
                "blog_content" => "Essential cybersecurity tips to help small businesses protect their data and systems.",
                "date_published" => "2024-02-17"
            ],
            [
                "id" => 10,
                "author" => "Chloe Martinez",
                "blog_title" => "Sustainable Business Practices in 2024",
                "blog_content" => "How businesses can integrate sustainability into their operations and increase brand loyalty.",
                "date_published" => "2024-02-19"
            ]

        ];

        public function index()
        {
            return view('student.blog', ['users' => $this->users]);
        }

        public function create()
                {
                    return view('student.blog-create');
                }

                public function show($id)
                {
                    $user = collect($this->users)->firstWhere('id', $id);

                    if (!$user) {
                        abort(404, 'User not found');
                    }

                    return view('student.blog-show', ['user' => $user]);
                }

                public function store(Request $request)
                {
                    $data = $request->validate([
                       'author' => 'required',
                       'blog_title' => 'required',
                       'blog_content' => 'required',
                       ]);

                       $data['id'] = count($this->users) + 1;
                       $data['date_published'] = now()->toDateString();

                       $this->users[] = $data;

                       return view('student.blog', ['users' => $this->users]);
                }

                public function edit($id)
                {
                    $user = collect($this->users)->firstWhere('id', $id);

                    if (!$user) {
                        abort(404, 'User not found');
                    }

                    return view('student.blog-edit', ['user' => $user]);
                }

                public function update(Request $request, $id)
                {
                    $data = $request->validate([
                        'author' => 'required',
                        'blog_title' => 'required',
                        'blog_content' => 'required',
                    ]);

                    $user = collect($this->users)->firstWhere('id', $id);

                    if (!$user) {
                        abort(404, 'User not found');
                    }

                    $user['author'] = $data['author'];
                    $user['blog_title'] = $data['blog_title'];
                    $user['blog_content'] = $data['blog_content'];

                    return view('student.blog-show', ['user' => $user]);
                }

                public function userCreate()
                {
                    return view('student.blog-ucreate');
                }
    }
