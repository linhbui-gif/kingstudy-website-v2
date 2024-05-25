import ApiService from '@/services';

export const config = {
  api: {
    bodyParser: true,
  },
};
export default async function handler(req, res) {
  try {
    const { params } = req.body.body;
    const response = await ApiService.get(`/school/filter-school`, {
      params: params,
    });
    const data = await response.data;
    res.status(200).json({ data });
  } catch (error) {
    res.status(500).json({ error: 'Internal Server Error' });
  }
}
