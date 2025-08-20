import { Resend } from 'resend';
export const prerender = false;

const resend = new Resend(import.meta.env.RESEND_API_KEY);

export async function POST({ request }: { request: Request }) {
  try {
    const body = await request.json();
    const { nombre, email, msj } = body;

    const data = await resend.emails.send({
      from: 'Portfolio <onboarding@resend.dev>',
      to: 'alan.union.1998@gmail.com',
      subject: `Nuevo mensaje de ${nombre}`,
      html: `
        <h3>Nuevo mensaje desde el portfolio </h3>
        <p><b>Nombre:</b> ${nombre}</p>
        <p><b>Email:</b> ${email}</p>
        <p><b>Mensaje:</b> ${msj}</p>
      `,
    });

    return new Response(JSON.stringify({ success: true, data }), { status: 200 });
  } catch (error: any) {
    return new Response(JSON.stringify({ error: error.message }), { status: 500 });
  }
}
